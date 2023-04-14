<?php
// public/index.php

require_once '../bootstrap.php';

session_start();

// Create a Request object
$request = new Http\Request();

// Create a Response object
$response = new Http\Response();

// Create a Router object and add routes
$router = new Core\Router();
// Get the container instance
$app = Core\App::getInstance();
$container = $app->getContainer();

$router->add('/', ['controller' => 'IndexController', 'action' => 'index']);
$router->add('/login', ['controller' => 'LoginController', 'action' => 'login']);
$router->add('/logout', ['controller' => 'LoginController', 'action' => 'logout']);
$router->add('/home', ['controller' => 'HomeController', 'action' => 'home']);
$router->add('/user-management', ['controller' => 'UserManagementController', 'action' => 'index']);
$router->add('/user-management/add', ['controller' => 'UserManagementController', 'action' => 'add']);
$router->add('/user-management/edit/{id}', ['controller' => 'UserManagementController', 'action' => 'edit']);
$router->add('/user-management/delete/{id}', ['controller' => 'UserManagementController', 'action' => 'delete']);

$router->addMiddleware(['/login'], $container->get('App\Middleware\RedirectIfAuthenticated'));
$router->addMiddleware(
    ['/home', '/user-management', '/user-management/add', '/user-management/edit/{id}', '/user-management/delete/{id}'],
    $container->get('App\Middleware\Authenticated')
);


// Create a RequestHandler object with dependencies
$requestHandler = new Http\RequestHandler($router, $request, $response, $container);

// Handle the request
try {
    $requestHandler->handle();
} catch (Exception $e) {
    echo $e->getMessage();
}
