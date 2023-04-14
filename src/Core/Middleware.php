<?php
namespace Core;

use src\Http\Response;

abstract class Middleware
{
    protected string $path;
    protected string $method;

    public function __construct($path, $method) {
        $this->path = $path;
        $this->method = $method;
    }

    public function __invoke($request, $next): Response {
        $method = $request->getMethod();
        $path = $request->getPath();
        if ($method == $this->method && $path == $this->path) {
            return $this->handle($request);
        }
        return $next($request);
    }
}