<?php
namespace App\Controllers;

use Core\View;
use Http\Request;
use Http\Response;

class IndexController
{
    /**
     * @throws \Exception
     */
    public function indexAction(Request $request, Response $response): void
    {
        $response->setBody(View::renderTemplate('index.html', [], true));
        $response->send();
    }
}