<?php
namespace App\Middleware;


use src\Http\Response;

class Authentication
{
    public function __invoke($request, $next)
    {
        global $app;
        $gebruiker = $app->getContainer()->make('App\Models\Gebruiker');
        if (isset($_POST['email'])) {
            $gebruikerdata = $gebruiker->findByEmail($_POST['email']);
        } else {
            $gebruikerdata = null;
        }


        $method = $request->getMethod();
        $path = $request->getPath();
        if ($method == 'POST' && $path == '/login'){
            if ($gebruikerdata) {
                if (password_verify($_POST['password'], $gebruikerdata['Wachtwoord'])) {
                    $_SESSION['gebruiker'] = $gebruikerdata;
                    return new Response(302, '', ['Location' => '/home']);
                } else {
                    return new Response(401, 'Wachtwoord is onjuist');
                }
            } else {
                return new Response(401, 'Gebruiker bestaat niet');
            }
        }
        return $next($request);
    }
}