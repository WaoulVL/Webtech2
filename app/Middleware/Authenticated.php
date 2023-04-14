<?php
namespace App\Middleware;

use Core\MiddlewareInterface;
use Http\Request;
use Http\Response;

class Authenticated implements MiddlewareInterface
{
    public function handle(Request $request, Response $response, callable $next): void
    {
        if (!isset($_SESSION['gebruiker'])) {
            $response->setStatusCode(302);
            $response->addHeader('Location', '/login');
            $_SESSION['error'] = 'U moet ingelogd zijn om die pagina te bekijken';
            $response->send();
            exit;
        }
        $next($request, $response);
    }
}