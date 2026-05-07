<?php

namespace App\Core;

class View
{
    public static function render(string $view, array $data = []): void
    {
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        if (!file_exists($viewPath)) {
            http_response_code(500);
            echo "View not found";
            return;
        }

        extract($data, EXTR_SKIP);

        ob_start();
        include $viewPath;
        $content = ob_get_clean();

        include __DIR__ . '/../views/layout.php';
    }

    public static function redirect(string $path): void
    {
        header('Location: ' . $path);
        exit;
    }
}
