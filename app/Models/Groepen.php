<?php
namespace App\Models;

use Core\Model;

class Groepen extends Model
{
    public function insertGroep(string $vak, string $groep): ?array {
        $statement = $this->database->getPdo()->prepare("INSERT INTO {$this->table} (VakID, Naam) VALUES (:VakID, :Naam)");
        $statement->execute([':VakID' => $vak, ':Naam' => $groep]);
        $result = $statement->fetch();

        return $result ? $result : null;
    }
}