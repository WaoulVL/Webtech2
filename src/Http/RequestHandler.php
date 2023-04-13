<?php
// src/Http/RequestHandler.php

namespace src\Http;

class RequestHandler
{
    private array $middlewares = [];

    public function addMiddleware(callable $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    public function handleRequest(Request $request): Response
    {
        $middleware = array_shift($this->middlewares);
        if ($middleware) {
            return $middleware($request, function (Request $request) {
                return $this->handleRequest($request);
            });
        }

        return new Response(404, '404 - Not found');
    }
}
