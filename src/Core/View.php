<?php
// core/View.php

namespace Core;

class View
{
    public static function renderTemplate(string $template, array $data = [], bool $returnAsString = false): false|string|null
    {
        $file = "../app/Views/{$template}";
        if (file_exists($file)) {
            extract($data, EXTR_SKIP);

            if ($returnAsString) {
                ob_start();
            }

            require $file;

            if ($returnAsString) {
                return (string)ob_get_clean();
            }
        } else {
            throw new \Exception("View template file '{$template}' not found.");
        }
        return null;
    }
}
