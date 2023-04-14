<?php
namespace App\Middleware;

use src\Http\Response;

class AddGebruiker
{
    public function __invoke($request, $next)
    {
        $app = $request->getAttribute('app');

        if (isset($_SESSION['gebruiker'])) {
            if ($_SESSION['gebruiker']['Rol'] != 'beheerder') {
                return new Response(302, '', '/home');
            }
        }

        $gebruiker = $app->getContainer()->make('App\Models\Gebruiker');

        $path = $request->getPath();
        $method = $request->getMethod();

        if ($method == 'POST' && $path == '/addGebruiker') {
            $naam = $request->getAttribute('naam');
            $achternaam = $request->getAttribute('achternaam');
            $geboorteDatum = $request->getAttribute('geboortedatum');
            $email = $request->getAttribute('email');
            $telefoonnummer = $request->getAttribute('telefoonnummer');
            $wachtwoord = $request->getAttribute('wachtwoord');
            $wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
            $rol = $request->getAttribute('rol');
            if (empty($naam) || empty($achternaam) || empty($geboorteDatum) || empty($email) || empty($telefoonnummer) || empty($wachtwoord) || empty($rol)) {
                return new Response(400, 'Vul alle velden in');
            }
            $gebruiker->insertGebruiker($naam, $achternaam, $geboorteDatum, $email, $telefoonnummer, $wachtwoord, $rol);
            return new Response(302, '', '/home');
        }

        return $next($request);
    }
}