<?php
// src/Core/Model.php

namespace Core;

abstract class Model
{
    protected Database $database;
    protected string $table;
    protected string $primaryKey;

    public function __construct(Database $database, string $table, string $primaryKey)
    {
        $this->database = $database;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    public function find(int $id): ?array
    {
        $statement = $this->database->getPdo()->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $statement->execute([':id' => $id]);
        $result = $statement->fetch();

        return $result ? $result : null;
    }

    public function findAll(): ?array
    {
        $statement = $this->database->getPdo()->prepare("SELECT * FROM {$this->table}");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result ? $result : null;
    }

    public function delete(int $id): void
    {
        $statement = $this->database->getPdo()->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $statement->execute([':id' => $id]);
    }
}
