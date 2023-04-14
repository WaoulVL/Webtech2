<?php
namespace App\Template;

use src\Http\Response;

class head {
    public function render(string $title) {
        ?>
        <head>
            <title><?=$title?></title>
            <link rel="stylesheet" href="css/style.css">
        </head>
        <?php
        return ob_get_clean();
    }
}