<?php
// src/Http/RequestHandler.php

namespace Http;

use Core\Container;
use Core\Router;

class RequestHandler
{
    private Router $router;
    private Request $request;
    private Response $response;
    private Container $container;

    public function __construct(Router $router, Request $request, Response $response, $container)
    {
        $this->router = $router;
        $this->request = $request;
        $this->response = $response;
        $this->container = $container;
    }

    /**
     * @throws \Exception
     */
    public function handle(): void
    {
        $this->router->dispatch($this->request, $this->container, $this->response);
    }
}
