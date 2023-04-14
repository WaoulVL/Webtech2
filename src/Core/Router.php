<?php
// core/Router.php

namespace Core;

use Exception;
use Http\Request;
use Http\Response;

class Router
{
    private array $routes = [];
    private array $middlewares = [];

    public function add(string $route, array $params): void
    {
        $this->routes[$route] = $params;
    }

    public function addMiddleware(array $routes, MiddlewareInterface $middleware): void
    {
        foreach ($routes as $route) {
            $this->middlewares[$route][] = $middleware;
        }
    }

    public function match(string $url): ?array
    {
        $url = explode('?', $url)[0];
        foreach ($this->routes as $route => $params) {
            $routePattern = preg_replace('/{([^\/]+)}/', '(?P<$1>[^\/]+)', $route);
            if (preg_match("#^$routePattern$#", $url, $matches)) {
                $params['matches'] = $matches;
                return $params;
            }
        }
        return null;
    }

    /**
     * @throws Exception
     */
    public function dispatch(Request $request, Container $container, Response $response): void
    {
        $url = $request->getUri();
        $params = $this->match($url);

        if ($params) {
            $middlewares = $this->middlewares[$url] ?? [];
            $controllerName = 'App\Controllers\\' . $params['controller'];
            $controller = $container->get($controllerName);
            $action = $params['action'] . 'Action';

            $middlewareRunner = function (Request $request, Response $response) use (
                $controllerName,
                $controller,
                $action,
                $params
            ) {
                if (method_exists($controller, $action)) {
                    $controller->$action($request, $response, $params['matches']);
                } else {
                    echo "Method $action not found in controller $controllerName.";
                }
            };

            foreach (array_reverse($middlewares) as $middleware) {
                $middlewareRunner = function (Request $request, Response $response) use (
                    $middleware,
                    $middlewareRunner
                ) {
                    $middleware->handle($request, $response, $middlewareRunner);
                };
            }

            $middlewareRunner($request, $response);
        } else {
            $response->setStatusCode(404);
            $response->setBody(View::renderTemplate('c404.html', [], true));
            $response->send();
        }
    }
}
