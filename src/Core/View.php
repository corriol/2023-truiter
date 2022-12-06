<?php

namespace App\Core;

class View
{
    static public function render(string $view, string $layout = 'default.layout.php', array $data = []): string {

        extract($data);

        ob_start();
        require __DIR__ . "/../../views/{$view}.view.php";
        $content = ob_get_clean();

        ob_start();
        require __DIR__ . "/../../views/layouts/{$layout}.layout.php";

        return ob_get_clean();
    }
}