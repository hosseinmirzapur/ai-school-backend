<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\External\ChatGPT;
use App\Models\Chat;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Throwable;

readonly class ChatService
{
    public function __construct(private ChatGPT $chatGPT)
    {
    }

    /**
     * @param string $type
     * @return array
     */
    public function newChat(string $type): array
    {
        // `type` validation
        if (!in_array($type, ['casual', 'quiz'])) {
            return [
                'message' => 'type_err',
                'status' => 400
            ];
        }
        /** @var Student $student */
        $student = request()->user();

        /** @var Chat $chat */
        if ($type === 'casual') {
            $chat = $student->newCasual();
        } else {
            $chat = $student->newQuiz();
        }

        return [
            'identifier' => $chat->identifier,
        ];
    }

    /**
     * @throws CustomException
     */
    public function sendMessage(string $identifier, array $data): array
    {
        /** @var Chat $chat */
        $chat = Chat::whereIdentifier($identifier)->firstOrFail();

        try {
            $result = DB::transaction(function () use ($chat, $data) {
                // Extract data from request
                $content = $data['content'];
                $hasFile = isset($data['file']);
                $hasVoice = isset($data['voice']);

                // Prepare data to send to chatgpt
                $aiData = [];
                $aiData['content'] = $content;
                $aiData['file'] = $hasFile ? $data['file'] : null;
                $aiData['voice'] = $hasVoice ? $data['voice'] : null;

                // Send `aiData` to chatgpt
                $response = $this->chatGPT->generate($aiData);

                // Save into DB after receiving response from chatgpt
                $chat->messages()->create([
                    'role' => 'user',
                    'content' => $content,
                    'has_file' => $hasFile,
                    'has_voice' => $hasVoice,
                ]);
                $chat->messages()->create([
                    'role' => 'bot',
                    'content' => $response,
                ]);

                return $response;
            }, attempts: 2);

            return [
                'result' => $result
            ];
        } catch (Throwable $exception) {
            throw new CustomException(
                $exception->getMessage(),
                $exception->getCode()
            );
        }

    }
}
