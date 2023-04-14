<?php
// src/Middleware/MiddlewareInterface.php

namespace Core;

use Http\Request;
use Http\Response;

interface MiddlewareInterface
{
    public function handle(Request $request, Response $response, callable $next): void;
}
