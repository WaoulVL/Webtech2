<?php
namespace App\Controllers;

use Core\View;
use Http\Request;
use Http\Response;

class HomeController
{
    /**
     * @throws \Exception
     */
    public function homeAction(Request $request, Response $response): void
    {
        $gebruiker = $_SESSION['gebruiker'];

        $data = [
            'gebruiker' => $gebruiker
        ];
        switch ($gebruiker['Rol']) {
            case 'beheerder':
                $response->setBody(View::renderTemplate('home_beheerder.php', $data, true));
                break;
            case 'docent':
                $response->setBody(View::renderTemplate('home_docent.php', [], true));
                break;
            case 'student':
                $response->setBody(View::renderTemplate('home_student.php', [], true));
                break;
        }

        $response->send();
    }
}