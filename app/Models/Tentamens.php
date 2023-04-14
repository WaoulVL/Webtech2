<?php
namespace App\Models;

use Core\Model;

class Tentamens extends Model
{
    public function insertTentamen(string $vak, string $tentamen, string $datum, string $tijd, string $locatie, string $tijdsduur )
    {
        $statement = $this->database->getPdo()->prepare("INSERT INTO {$this->table} (VakID, Naam, Datum, Tijd, Locatie, Tijdsduur) VALUES (:vak, :tentamen, :datum, :tijd, :locatie, :tijdsduur)");
        $statement->execute([':vak' => $vak, ':tentamen' => $tentamen, ':datum' => $datum, ':tijd' => $tijd, ':locatie' => $locatie, ':tijdsduur' => $tijdsduur]);
        $result = $statement->fetch();

        return $result ? $result : null;
    }
}