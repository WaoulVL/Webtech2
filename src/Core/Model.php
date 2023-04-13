<?php
// src/Core/Model.php

namespace Core;

abstract class Model
{
    protected Database $database;
    protected string $table;
    protected string $primaryKey;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function find(int $id): ?array
    {
        $statement = $this->database->getPdo()->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $statement->execute([':id' => $id]);
        $result = $statement->fetch();

        return $result ? $result : null;
    }

    // Implementeer hier aanvullende ORM-functies zoals save() en delete().

}

