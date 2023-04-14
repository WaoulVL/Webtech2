<?php
namespace App\Middleware;

use src\Http\Response;

class addVak {
    public function __invoke($request, $next) {
        global $app;
        $vakken = $app->getContainer()->make('App\Models\Vakken');

        $path = $request->getPath();
        $method = $request->getMethod();
        $course = $request->getAttribute('course');
        $vak = $request->getAttribute('vak');
        $beschrijving = $request->getAttribute('beschrijving');

        if ($method == 'POST' && $path == '/addVak') {
            if (empty($vak) || empty($beschrijving) || empty($course)) {
                return new Response(400, 'Vul alle velden in');
            }
            $vakken->insertVak($course, $vak, $beschrijving);
            return new Response(302, '', '/home');
        }

        return $next($request);
    }
}