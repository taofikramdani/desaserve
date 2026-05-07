<?php

namespace App\Helpers;

function base_url(string $path = ''): string
{
    $base = rtrim(getenv('APP_BASE_URL') ?: '', '/');
    if ($base === '') {
        return $path ?: '/';
    }

    return $base . '/' . ltrim($path, '/');
}

function asset_url(string $path): string
{
    $assetBase = rtrim(getenv('ASSET_BASE_URL') ?: '', '/');
    $path = ltrim($path, '/');

    if ($assetBase === '') {
        return '/assets/' . $path;
    }

    return $assetBase . '/' . $path;
}
