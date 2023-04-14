<?php
namespace App\Models;

use Core\Model;

class docent_vakken extends Model
{
    public function insertDocentVak(int $docent, int $vak): ?array {
        $statement = $this->database->getPdo()->prepare("INSERT INTO {$this->table} (DocentID, VakID) VALUES (:docent, :vak)");
        $statement->execute([':docent' => $docent, ':vak' => $vak]);
        $result = $statement->fetch();

        return $result ? $result : null;
    }
}