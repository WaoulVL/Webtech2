<?php
namespace src\Http;

class Response
{
    private int $statusCode;
    private string $body;

    public function __construct(int $statusCode, string $body, array $headers = [])
    {
        $this->statusCode = $statusCode;
        $this->body = $body;
        foreach ($headers as $header => $value) {
            header($header . ': ' . $value);
        }
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}