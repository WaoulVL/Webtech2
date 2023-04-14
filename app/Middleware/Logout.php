<?php
namespace App\Middleware;

use src\Http\Response;

class Logout
{
    public function __invoke($request, $next)
    {
        $path = $request->getPath();
        $method = $request->getMethod();
        if ($path === '/logout' && $method === 'POST') {
            session_destroy();
            return new Response(302, '', '/login');
        }

        return $next($request);
    }
}