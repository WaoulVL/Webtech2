<?php

spl_autoload_register(
    function ($className) {
        $classMap = [
            'App\\Controllers\\' => 'app/Controllers/',
            'App\\Middleware\\' => 'app/Middleware/',
            'App\\Models\\' => 'app/Models/',
            'App\\Template\\' => 'app/Template/',
            'App\\Views\\' => 'app/Views/',
            'Core\\' => 'src/Core/',
            'Http\\' => 'src/Http/'
        ];
        foreach ($classMap as $prefix => $baseDir) {
            if (str_starts_with($className, $prefix)) {
                $relativeClass = substr($className, strlen($prefix));
                $relativeClass = str_replace('\\', '/', $relativeClass);
                $classFile = $baseDir . $relativeClass . '.php';
                require_once $classFile;
                return;
            }
        }
    }
);

// Maak de App singleton
$app = Core\App::getInstance();

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

// Registreer controllers en hun afhankelijkheden
$app->getContainer()->bind('App\Controllers\IndexController', function ($container) {
    return new App\Controllers\IndexController();
});

$app->getContainer()->bind('App\Controllers\LoginController', function ($container) {
    $gebruikersModel = new App\Models\Gebruiker($container->get('Core\Database'), 'gebruikers', 'GebruikerID');
    return new App\Controllers\LoginController($gebruikersModel);
});

$app->getContainer()->bind('App\Controllers\HomeController', function ($container) {
    return new App\Controllers\HomeController();
});

$app->getContainer()->bind('App\Controllers\UserManagementController', function ($container) {
    $gebruikersModel = new App\Models\Gebruiker($container->get('Core\Database'), 'gebruikers', 'GebruikerID');
    return new App\Controllers\UserManagementController($gebruikersModel);
});

//middelware
$app->getContainer()->bind('App\Middleware\RedirectIfAuthenticated', function ($container) {
    return new App\Middleware\RedirectIfAuthenticated();
});

$app->getContainer()->bind('App\Middleware\Authenticated', function ($container) {
    return new App\Middleware\Authenticated();
});