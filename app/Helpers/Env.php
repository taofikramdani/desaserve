<?php

namespace App\Helpers;

class Env
{
    public static function load(string $path): void
    {
        if (!file_exists($path)) {
            return;
        }

        $vars = parse_ini_file($path, false, INI_SCANNER_RAW);
        if (!$vars) {
            return;
        }

        foreach ($vars as $key => $value) {
            if (getenv($key) !== false) {
                continue;
            }

            $_ENV[$key] = $value;
            putenv("{$key}={$value}");
        }
    }
}
