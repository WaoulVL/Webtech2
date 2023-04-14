<?php

namespace App\Views;

use src\Http\response;

class DocentHomeView{

    public function render() {
        global $app;
        $head = $app->getContainer()->make('App\Template\head');
        $headHtml = $head->render('Home');

        ob_start();
        ?>
        <?php echo $headHtml; ?>

        <?php
        return new Response(200, (string)ob_get_clean());


    }
}