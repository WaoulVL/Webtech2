<?php

namespace Http;

class Request
{
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function getAttribute(string $key)
    {
        return $_REQUEST[$key] ?? null;
    }

    public function getAttributes(): array
    {
        return $_REQUEST;
    }
}
