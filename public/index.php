<?php
// public/index.php

global $app;
require_once '../bootstrap.php';

use src\Http\Request;
use src\Http\RequestHandler;
use src\Http\Response;

session_start();
$router = $app->getContainer()->make('src\Routing\Router');

$router->get('/login', function () {
    global $app;

    if (isset($_SESSION['gebruiker'])) {
        return new Response(302, '', '/home');
    }

    $loginView = $app->getContainer()->make('App\Views\LoginView');
    return $loginView->render();
});

$router->get('/home', function () {
    global $app;
    if (!isset($_SESSION['gebruiker'])) {
        return new Response(302, '', '/login');
    }
    if ($_SESSION['gebruiker']['Rol'] == 'beheerder') {
        $beheerderHomeView = $app->getContainer()->make('App\Views\BeheerderHomeView');
        return $beheerderHomeView->render();
    }
    if ($_SESSION['gebruiker']['Rol'] == 'docent') {
        $docentHomeView = $app->getContainer()->make('App\Views\DocentHomeView');
        return $docentHomeView->render();
    }
    if ($_SESSION['gebruiker']['Rol'] == 'student') {
        $studentHomeView = $app->getContainer()->make('App\Views\StudentHomeView');
        return $studentHomeView->render();
    }
    return new Response(401, 'Geen toegang');
});

$authentication = $app->getContainer()->make('App\Middleware\Authentication');
$addCourse = $app->getContainer()->make('App\Middleware\AddOpleiding');
$logout = $app->getContainer()->make('App\Middleware\Logout');

$request = new Request($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
$request = $request->withAttribute('app', $app);

$requestHandler = new RequestHandler();
$requestHandler->addMiddleware($router);
$requestHandler->addMiddleware($authentication);
$requestHandler->addMiddleware($addCourse);
$requestHandler->addMiddleware($logout);

$response = $requestHandler->handleRequest($request);

http_response_code($response->getStatusCode());
echo $response->getBody();
