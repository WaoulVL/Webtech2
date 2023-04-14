<?php
namespace App\Middleware;

use src\Http\Response;

class AddDocentvakken
{
    public function __invoke($request, $next)
    {
        $app = $request->getAttribute('app');
        $docent_vakken = $app->getContainer()->make('App\Models\docent_vakken');

        $path = $request->getPath();
        $method = $request->getMethod();
        $docent = $request->getAttribute('docent');
        $vak = $request->getAttribute('vak');

        if ($method == 'POST' && $path == '/addDocent_vakken') {
            if (empty($docent) || empty($vak)) {
                return new Response(400, 'Vul alle velden in');
            }
            $docent_vakken->insertDocentVak($docent, $vak);
            return new Response(302, '', '/home');
        }

        return $next($request);
    }
}