<?php
namespace src\Http;

class Response
{
    private int $statusCode;
    private string $body;

    public function __construct(int $statusCode, string $body, string $header = '')
    {
        $this->statusCode = $statusCode;
        $this->body = $body;
        if ($header) {
            header("Location: $header");
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