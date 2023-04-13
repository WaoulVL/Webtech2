<?php
// src/Core/App.php

namespace Core;

class App
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function getContainer(): Container
    {
        return $this->container;
    }
}
