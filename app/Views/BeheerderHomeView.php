<?php

namespace App\Views;

use src\Http\Response;

class BeheerderHomeView
{
    public function render()
    {
        ob_start();
        ?>
        <form method="post" action="/addOpleiding">
            <label for="opleiding">Opleiding</label>
            <input type="text" name="opleiding" id="opleiding">
            <label for="beschrijving">Description</label>
            <input type="text" name="beschrijving" id="beschrijving">
            <input type="submit" value="Add course">
        </form>
        <?php
        return new Response(200, (string)ob_get_clean());
    }
}