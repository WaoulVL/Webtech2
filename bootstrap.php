<?php
// bootstrap.php

require_once 'src/Core/Container.php';
require_once 'src/Core/App.php';
require_once 'src/Core/Model.php';
require_once 'app/Models/Gebruiker.php';
require_once 'src/Core/Database.php';
require_once 'src/Routing/Router.php';
require_once 'src/Http/Request.php';
require_once 'src/Http/Response.php';
require_once 'src/Http/RequestHandler.php';
require_once 'app/Views/LoginView.php';
require_once 'app/Middleware/Authentication.php';
require_once 'app/Views/BeheerderHomeView.php';
require_once 'app/Models/Opleidingen.php';
require_once 'app/Middleware/AddOpleiding.php';

$app = new Core\App();

// Database-configuratie
$dbConfig = [
    'dsn' => 'mysql:host=localhost;dbname=webtechii;charset=utf8',
    'username' => 'webtechii',
    'password' => 'Stroopwafel125',
];

// Registreer de Database-klasse
$app->getContainer()->bind('Core\Database', function () use ($dbConfig) {
    return new Core\Database($dbConfig['dsn'], $dbConfig['username'], $dbConfig['password']);
});

// Registreer het Gebruiker-model
$app->getContainer()->bind('App\Models\Gebruiker', function ($container) {
    return new App\Models\Gebruiker($container->make('Core\Database'));
});

// Registreer de Router-klasse
$app->getContainer()->bind('src\Routing\Router', function () {
    return new Routing\Router();
});

$app->getContainer()->bind('src\Http\RequestHandler', function () {
    return new src\Http\RequestHandler();
});

// Registreer de LoginView
$app->getContainer()->bind('App\Views\LoginView', function () {
    return new App\Views\LoginView();
});

$app->getContainer()->bind('App\Views\BeheerderHomeView', function () {
    return new App\Views\BeheerderHomeView();
});

// Registreer de Authentication-middleware
$app->getContainer()->bind('App\Middleware\Authentication', function () {
    return new App\Middleware\Authentication();
});

$app->getContainer()->bind('App\Models\Opleidingen', function ($container) {
    return new App\Models\Opleidingen($container->make('Core\Database'));
});

$app->getContainer()->bind('App\Middleware\AddOpleiding', function () {
    return new App\Middleware\AddOpleiding();
});