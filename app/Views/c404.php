<?php

namespace App\Views;

use src\Http\Response;
class c404 {
    public function render() {

        global $app;
        $head = $app->getContainer()->make('App\Template\head');
        $headHtml = $head->render('Home');
        ob_start();
        ?>
        <?php echo $headHtml; ?>
        <h1>404</h1>
        <p>Oops! The page you're looking for can't be found. Please check the URL and try again</p>
        <a href="/">Go back to the homepage</a>
        <?php
        return new Response(404, (string)ob_get_clean());
    }
}