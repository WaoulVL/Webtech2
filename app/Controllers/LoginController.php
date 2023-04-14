<?php

namespace App\Controllers;

use Core\View;
use Http\Response;

class LoginController
{
    private $gebruikersModel;

    public function __construct($gebruikersModel)
    {
        $this->gebruikersModel = $gebruikersModel;
    }

    /**
     * @throws \Exception
     */
    public function loginAction($request, $response): void
    {
        if ($request->getMethod() == "POST") {
            $email = $request->getAttribute('email');
            $wachtwoord = $request->getAttribute('password');
            $gebruiker = $this->gebruikersModel->findByEmail($email);
            if ($gebruiker) {
                if (password_verify($wachtwoord, $gebruiker['Wachtwoord'])) {
                    $_SESSION['gebruiker'] = $gebruiker;
                    $response->setStatusCode(302);
                    $response->addHeader('Location', '/home');
                    $response->send();
                    exit;
                } else {
                    $_SESSION['error'] = 'Wachtwoord is onjuist';
                    $response->setStatusCode(303);
                    $response->addHeader('Location', '/login');
                    $response->send();
                    exit;
                }
            } else {
                $_SESSION['error'] = 'Gebruiker bestaat niet';
                $response->setStatusCode(303);
                $response->addHeader('Location', '/login');
                $response->send();
                exit;
            }
        } else {
            $error = $_SESSION['error'] ?? null;
            unset($_SESSION['error']);
            $response->setBody(View::renderTemplate('login.php', ['error' => $error], true));
            $response->send();
        }
    }

    public function logoutAction($request, $response): void
    {
        session_destroy();

        $response->setStatusCode(302);
        $response->addHeader('Location', '/');
        $response->send();
    }

}
