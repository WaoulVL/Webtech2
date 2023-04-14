<?php

namespace App\Models;

use Core\Model;

class Courses extends Model
{
    public function insertCourse(string $opleiding, string $course, string $beschrijving): ?array {
        $statement = $this->database->getPdo()->prepare("INSERT INTO {$this->table} (OpleidingID, Naam, Beschrijving) VALUES (:opleiding, :course, :beschrijving)");
        $statement->execute([':opleiding' => $opleiding, ':course' => $course,':beschrijving' => $beschrijving]);
        $result = $statement->fetch();

        return $result ? $result : null;
    }
}
