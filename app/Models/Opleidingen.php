<?php
// app/Models/Gebruiker.php

namespace App\Models;

use Core\Model;

class Opleidingen extends Model
{
    protected string $table = 'Opleidingen';
    protected string $primaryKey = 'OpleidingID';

    public function insertOpleiding(string $opleiding, string $beschrijving): ?array {
        $statement = $this->database->getPdo()->prepare("INSERT INTO {$this->table} (Naam, Beschrijving) VALUES (:opleiding, :beschrijving)");
        $statement->execute([':opleiding' => $opleiding, ':beschrijving' => $beschrijving]);
        $result = $statement->fetch();

        return $result ? $result : null;
    }
}
