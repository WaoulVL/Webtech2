<?php
// src/Core/Database.php

namespace Core;

use PDO;

class Database
{
    private PDO $pdo;

    public function __construct(string $dsn, string $username, string $password, array $options = [])
    {
        $this->pdo = new PDO($dsn, $username, $password, $options);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
