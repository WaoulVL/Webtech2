<?php

namespace Routing;

use src\Http\Request;
use src\Http\Response;

class Router
{
    private array $routes = [];

    public function __invoke(Request $request, callable $next): Response
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $request->getMethod() && $route['path'] === $request->getPath()) {
                return $route['callback']($request, $next);
            }
        }

        return $next($request);
    }

    private function addRoute(string $method, string $path, $callback): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'callback' => $callback,
        ];
    }

    public function get(string $path, $callback): void
    {
        $this->addRoute('GET', $path, $callback);
    }

    public function post(string $path, $callback): void
    {
        $this->addRoute('POST', $path, $callback);
    }
}