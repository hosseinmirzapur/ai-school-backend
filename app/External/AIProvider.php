<?php

namespace App\External;

use App\Exceptions\CustomException;

abstract class AIProvider
{
    protected string $apiKey;
    protected string $baseUrl;
    protected array $headers;

    /**
     * @param array $prompt
     * @return string
     * @throws CustomException
     */
    abstract public function generate(array $prompt): string;

}
