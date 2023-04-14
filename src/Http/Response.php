<?php
namespace Http;

class Response
{
    private int $statusCode;
    private string $body;
    private array $headers;

    public function __construct(int $statusCode = 200, string $body = '', array $headers = [])
    {
        $this->statusCode = $statusCode;
        $this->body = $body;
        $this->headers = $headers;
    }

    public function send(): void
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $header => $value) {
            header("$header: $value");
        }

        echo $this->body;
    }

    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    public function addHeader(string $key, string $value): void
    {
        $this->headers[$key] = $value;
    }

    public function setBody(?string $renderTemplate): void
    {
        $this->body = $renderTemplate;
    }
}