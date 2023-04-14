<?php

namespace App\Models;

use Core\Model;

class Vakken extends Model
{
    public function insertVak(string $course, string $vak, string $beschrijving): ?array {
        $statement = $this->database->getPdo()->prepare("INSERT INTO {$this->table} (CourseID, Naam, Beschrijving) VALUES (:course, :vak, :beschrijving)");
        $statement->execute([':course' => $course, ':vak' => $vak,':beschrijving' => $beschrijving]);
        $result = $statement->fetch();

        return $result ? $result : null;
    }
}