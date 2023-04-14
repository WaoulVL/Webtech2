<?php
// app/Middleware/RedirectIfAuthenticated.php

namespace App\Middleware;

use Http\Request;
use Http\Response;
use Core\MiddlewareInterface;

class RedirectIfAuthenticated implements MiddlewareInterface
{
    public function handle(Request $request, Response $response, callable $next): void
    {
        if (isset($_SESSION['gebruiker'])) {
            // Gebruiker is ingelogd, dus redirect naar een andere pagina
            $response->setStatusCode(302);
            $response->addHeader('Location', '/home');
            $response->send();
            exit();
        }

        // Gebruiker is niet ingelogd, dus ga verder met de volgende middleware of controller
        $next($request, $response);
    }
}
