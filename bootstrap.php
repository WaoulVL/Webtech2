<?php
// bootstrap.php

require_once 'src/Core/Container.php';
require_once 'src/Core/App.php';
require_once 'src/Core/Model.php';
require_once 'src/Core/Middleware.php';
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
require_once 'app/Views/c404.php';
require_once 'app/Middleware/Logout.php';
require_once 'app/Template/head.php';
require_once 'app/Middleware/AddCourse.php';
require_once 'app/Models/Courses.php';
require_once 'app/Models/Vakken.php';
require_once 'app/Middleware/AddVak.php';
require_once 'app/Models/Tentamens.php';
require_once 'app/Middleware/AddTentamen.php';
require_once 'app/Middleware/AddGebruiker.php';
require_once 'app/Models/docent_vakken.php';
require_once 'app/Middleware/AddDocentvakken.php';

$app = new Core\App();

// Database-configuratie
$dbConfig = [
    'dsn' => 'mysql:host=localhost;dbname=webtech;charset=utf8',
    'username' => 'root',
    'password' => 'Stroopwafel125',
];

// Registreer de Database-klasse
$app->getContainer()->bind('Core\Database', function () use ($dbConfig) {
    return new Core\Database($dbConfig['dsn'], $dbConfig['username'], $dbConfig['password']);
});

// Registreer het Gebruiker-model
$app->getContainer()->bind('App\Models\Gebruiker', function ($container) {
    return new App\Models\Gebruiker($container->make('Core\Database'), 'gebruikers', 'GebruikerID');
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
    return new App\Middleware\Authentication('/login', 'POST');
});

$app->getContainer()->bind('App\Models\Opleidingen', function ($container) {
    return new App\Models\Opleidingen($container->make('Core\Database'), 'opleidingen', 'OpleidingID');
});

$app->getContainer()->bind('App\Middleware\AddOpleiding', function () {
    return new App\Middleware\AddOpleiding();
});

$app->getContainer()->bind('App\Views\c404', function () {
    return new App\Views\c404();
});

$app->getContainer()->bind('App\Middleware\Logout', function () {
    return new App\Middleware\Logout();
});

$app->getContainer()->bind('App\Template\head', function () {
    return new App\Template\head();
});

$app->getContainer()->bind('App\Models\Courses', function ($container) {
    return new App\Models\Courses($container->make('Core\Database'), 'courses', 'CourseID');
});

$app->getContainer()->bind('App\Middleware\AddCourse', function () {
    return new App\Middleware\AddCourse();
});

$app->getContainer()->bind('App\Models\Vakken', function ($container) {
    return new App\Models\Vakken($container->make('Core\Database'), 'vakken', 'VakID');
});

$app->getContainer()->bind('App\Middleware\AddVak', function () {
    return new App\Middleware\AddVak();
});

$app->getContainer()->bind('App\Models\Tentamens', function ($container) {
    return new App\Models\Tentamens($container->make('Core\Database'), 'tentamens', 'TentamenID');
});

$app->getContainer()->bind('App\Middleware\AddTentamen', function () {
    return new App\Middleware\AddTentamen();
});

$app->getContainer()->bind('App\Middleware\AddGebruiker', function () {
    return new App\Middleware\AddGebruiker();
});

$app->getContainer()->bind('App\Models\docent_vakken', function ($container) {
    return new App\Models\docent_vakken($container->make('Core\Database'), 'docenten_vakken', 'Docent_VakID');
});

$app->getContainer()->bind('App\Middleware\AddDocentvakken', function () {
    return new App\Middleware\AddDocentvakken();
});