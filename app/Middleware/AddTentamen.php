<?php
namespace App\Middleware;

use src\Http\Response;

class AddTentamen
{
    public function __invoke($request, $next)
    {
        $app = $request->getAttribute('app');

        $path = $request->getPath();
        $method = $request->getMethod();
        $vak = $request->getAttribute('vak');
        $naam = $request->getAttribute('naam');
        $datum = $request->getAttribute('datum');
        $tijd = $request->getAttribute('tijd');
        $locatie = $request->getAttribute('locatie');
        $tijdsduur = $request->getAttribute('tijdsduur');

        if ($method == 'POST' && $path == '/addTentamen') {
            if (empty($vak) || empty($naam) || empty($datum) || empty($tijd) || empty($locatie) || empty($tijdsduur)) {
                return new Response(400, 'Vul alle velden in');
            }
            $tentamens = $app->getContainer()->make('App\Models\Tentamens');
            $tentamens->insertTentamen($vak, $naam, $datum, $tijd, $locatie, $tijdsduur);
            return new Response(302, '', '/home');
        }

        return $next($request);
    }
}