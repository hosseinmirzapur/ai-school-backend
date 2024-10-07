<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\SendMessageRequest;
use App\Services\ChatService;
use Illuminate\Http\JsonResponse;

class ChatController extends Controller
{
    public function __construct(private readonly ChatService $service)
    {
    }

    /**
     * @param string $type
     * @return JsonResponse
     */
    public function newChat(string $type): JsonResponse
    {
        $data = $this->service->newChat($type);
        return response()->json($data);
    }

    /**
     * @param SendMessageRequest $request
     * @param string $identifier
     * @return JsonResponse
     * @throws CustomException
     */
    public function sendMessage(SendMessageRequest $request, string $identifier): JsonResponse
    {
        $data = $this->service->sendMessage($identifier, $request->validated());
        return response()->json($data);
    }
}
