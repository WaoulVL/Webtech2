<?php
namespace App\Middleware;

use src\Http\Response;

class AddOpleiding
{
    public function __invoke($request, $next) {
        global $app;
        $opleidingen = $app->getContainer()->make('App\Models\Opleidingen');

        $path = $request->getPath();
        $method = $request->getMethod();
        $naam = $_POST['opleiding'];
        $beschrijving = $_POST['beschrijving'];

        if ($method == 'POST' && $path == '/addOpleiding') {
            if (empty($naam) || empty($beschrijving)) {
                return new Response(400, 'Vul alle velden in');
            }
            $opleidingen->insertOpleiding($naam, $beschrijving);
            return new Response(302, '', ['Location' => '/home']);
        }

        return $next($request);
    }
}