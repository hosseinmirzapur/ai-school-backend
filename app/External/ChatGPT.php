<?php

namespace App\External;

use App\Exceptions\CustomException;
use Illuminate\Support\Facades\Http;
use Throwable;

class ChatGPT extends AIProvider
{

    public function __construct()
    {
        $this->apiKey = strval(config('services.openai.key'));
        $this->baseUrl = strval(config('services.openai.baseUrl'));
        // this may change...
        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer " . $this->apiKey
        ];
    }

    /**
     * @param array $prompt
     * @return string
     * @throws CustomException
     */
    public function generate(array $prompt): string
    {
        try {
            $res = Http::withHeaders(
                $this->headers
            )
                ->post(
                    $this->baseUrl,
                    $prompt
                );
            return $res->body();
        } catch (Throwable $e) {
            throw new CustomException($e->getMessage());
        }
    }


}
