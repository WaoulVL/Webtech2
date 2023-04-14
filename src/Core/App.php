<?php
// src/Core/App.php
namespace Core;

class App
{
    private static ?App $instance = null;

    private Container $container;

    private function __construct()
    {
        $this->container = new Container();
    }

    public static function getInstance(): App
    {
        if (self::$instance === null) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    public function getContainer(): Container
    {
        return $this->container;
    }
}
