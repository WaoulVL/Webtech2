<?php

namespace App\Views;

use src\Http\Response;

class loginView {
    public function render() {
        global $app;
        $head = $app->getContainer()->make('App\Template\head');
        $headHtml = $head->render(
            'Login'
        );

        ob_start(); // Start de outputbuffering
        ?>
        <?php echo $headHtml; ?>
        <form method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="wachtwoord">Wachtwoord</label>
            <input type="password" name="wachtwoord" id="password">
            <input type="submit" value="Login">
        </form>
        <?php
        // Haal de inhoud van de outputbuffer op en stop deze in een variabele
        return new Response(200, (string)ob_get_clean()); // Geef de HTML terug aan de aanroeper van de methode
    }
}
