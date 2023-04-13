<?php
// app/Models/Gebruiker.php

namespace App\Models;

use Core\Model;

class Gebruiker extends Model
{
    protected string $table = 'Gebruikers';
    protected string $primaryKey = 'GebruikerID';

    public function findByEmail(string $email): ?array
    {
        $statement = $this->database->getPdo()->prepare("SELECT * FROM {$this->table} WHERE Email = :email");
        $statement->execute([':email' => $email]);
        $result = $statement->fetch();

        return $result ? $result : null;
    }

    public function findByPrimaryKey(int $id): ?array
    {
        $statement = $this->database->getPdo()->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");
        $statement->execute([':id' => $id]);
        $result = $statement->fetch();

        return $result ? $result : null;
    }
}
