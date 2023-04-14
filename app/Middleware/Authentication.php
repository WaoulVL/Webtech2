<?php

namespace App\Middleware;

use Core\Middleware;
use src\Http\Response;

class Authentication extends Middleware
{
    public function handle($request): Response
    {
        $app = $request->getAttribute('app');
        $gebruiker = $app->getContainer()->make('App\Models\Gebruiker');
        $email = $request->getAttribute('email');
        $wachtwoord = $request->getAttribute('wachtwoord');

        if ($email !== null) {
            $gebruikerdata = $gebruiker->findByEmail($email);
        } else {
            $gebruikerdata = null;
        }
        if ($gebruikerdata) {
            if (password_verify($wachtwoord, $gebruikerdata['Wachtwoord'])) {
                $_SESSION['gebruiker'] = $gebruikerdata;
                return new Response(302, '', 'home');
            } else {
                return new Response(401, 'Wachtwoord is onjuist');
            }
        } else {
            return new Response(401, 'Gebruiker bestaat niet');
        }
    }
}
