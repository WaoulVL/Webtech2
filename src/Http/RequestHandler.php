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
        global $app;
        foreach ($_REQUEST as $key => $value) {
            $request = $request->withAttribute($key, $value);
        }


        $middleware = array_shift($this->middlewares);
        if ($middleware) {
            return $middleware($request, function (Request $request) {
                return $this->handleRequest($request);
            });
        }

        $c404 = $app->getContainer()->make('App\Views\c404');

        return $c404->render();
    }
}
