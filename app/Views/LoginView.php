<?php

namespace App\Views;

use src\Http\Response;

class loginView {
    public function render() {
        ob_start(); // Start de outputbuffering
        ?>
        <form method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="password">Wachtwoord</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Login">
        </form>
        <?php
        // Haal de inhoud van de outputbuffer op en stop deze in een variabele
        return new Response(200, ob_get_clean()); // Geef de HTML terug aan de aanroeper van de methode
    }
}
