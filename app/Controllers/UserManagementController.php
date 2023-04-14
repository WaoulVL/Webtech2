<?php

namespace App\Controllers;

use Core\Model;
use Core\View;
use Http\Request;
use Http\Response;

class UserManagementController
{
    private Model $gebruikersModel;

    public function __construct($gebruikersModel)
    {
        $this->gebruikersModel = $gebruikersModel;
    }

    public function indexAction(Request $request, Response $response): void
    {
        $search = $request->getAttribute('search');

        $gebruikers = $this->gebruikersModel->findAll();

        if ($search) {
            $gebruikers = array_filter($gebruikers, function ($gebruiker) use ($search) {
                return strpos($gebruiker['Naam'], $search) !== false || strpos($gebruiker['Achternaam'], $search) !== false || strpos($gebruiker['Email'], $search) !== false || strpos($gebruiker['Rol'], $search) !== false || strpos($gebruiker['GebruikerID'], $search) !== false;
            });
        }

        $response->setBody(View::renderTemplate('user_management.php', ['gebruikers' => $gebruikers, 'search' => $search], true));
        $response->send();
    }

    /**
     * @throws \Exception
     */
    public function editAction(Request $request, Response $response, array $params): void
    {
        $id = $params['id'];

        $gebruiker = $this->gebruikersModel->find($id);
        if (!$gebruiker) {
            $response->setStatusCode(404);
            $response->setBody(View::renderTemplate('c404.html', [], true));
            $response->send();
            return;
        }
        $response->setBody(View::renderTemplate('user_management_edit.php', ['gebruiker' => $gebruiker], true));
        $response->send();
    }

    public function addAction(Request $request, Response $response): void
    {
//        check for post request
        if ($request->getMethod() == "POST") {
//            get all the data from the form
            $gebruiker = $request->getAttributes();
//            check if the email is already in use
            if ($this->gebruikersModel->findByEmail($gebruiker['email'])) {
                $response->setBody(View::renderTemplate('user_management_add.php', ['error' => 'Email is al in gebruik'], true));
                $response->send();
                return;
            } else {
                $this->gebruikersModel->insertGebruiker($gebruiker['naam'], $gebruiker['achternaam'], $gebruiker['geboortedatum'], $gebruiker['email'], $gebruiker['telefoonnummer'], $gebruiker['wachtwoord'], $gebruiker['rol']);
                $response->setStatusCode(302);
                $response->addHeader('Location', '/user-management');
                $response->send();
                exit;
            }
        }
        $response->setBody(View::renderTemplate('user_management_add.php', [], true));
        $response->send();
    }

    public function deleteAction(Request $request, Response $response, array $params): void
    {
        $id = $params['id'];

        $gebruiker = $this->gebruikersModel->find($id);
        if (!$gebruiker) {
            $response->setStatusCode(404);
            $response->setBody(View::renderTemplate('c404.html', [], true));
            $response->send();
            return;
        } elseif ($gebruiker == $_SESSION['gebruiker']) {
            $response->setStatusCode(302);
            $response->addHeader('Location', '/user-management');
            $response->send();
            exit;
        } elseif ($request->getMethod() == "POST") {
            $this->gebruikersModel->delete($id);
            $response->setStatusCode(302);
            $response->addHeader('Location', '/user-management');
            $response->send();
            exit;
        }
        $response->setBody(View::renderTemplate('user_management_delete.php', ['gebruiker' => $gebruiker], true));
        $response->send();
    }
}