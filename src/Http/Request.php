<?php

namespace src\Http;

class Request
{
    private string $method;
    private string $path;
    private array $attributes = [];

    public function __construct(string $method, string $path)
    {
        $this->method = $method;
        $this->path = $path;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getAttribute(string $key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function withAttribute(string $key, $value): self
    {
        $newRequest = clone $this;
        $newRequest->attributes[$key] = $value;

        return $newRequest;
    }
}
