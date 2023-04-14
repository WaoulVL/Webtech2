<?php
// app/Models/Gebruiker.php

namespace App\Models;

use Core\Model;

class Gebruiker extends Model
{
    public function findByEmail(string $email): ?array
    {
        $statement = $this->database->getPdo()->prepare("SELECT * FROM {$this->table} WHERE Email = :email");
        $statement->execute([':email' => $email]);
        $result = $statement->fetch();

        return $result ? $result : null;
    }

    public function insertGebruiker(string $naam, string $achternaam, string $geboortedatum, string $email, string $telefoonnummer, string $wachtwoord, string $rol): ?array
    {
        $statement = $this->database->getPdo()->prepare("INSERT INTO {$this->table} (Naam, Achternaam, Geboortedatum, Email, Telefoonnummer, Wachtwoord, Rol) VALUES (:naam, :achternaam, :geboortedatum, :email, :telefoonnummer, :wachtwoord, :rol)");
        $statement->execute([':naam' => $naam, ':achternaam' => $achternaam, ':geboortedatum' => $geboortedatum, ':email' => $email, ':telefoonnummer' => $telefoonnummer, ':wachtwoord' => password_hash($wachtwoord, PASSWORD_DEFAULT), ':rol' => $rol]);
        $result = $statement->fetch();

        return $result ? $result : null;
    }

    public function findAllRol(string $rol) {
        $statement = $this->database->getPdo()->prepare("SELECT * FROM {$this->table} WHERE Rol = :rol ORDER BY GebruikerID DESC");
        $statement->execute([':rol' => $rol]);
        $result = $statement->fetchAll();

        return $result ? $result : null;
    }
}
