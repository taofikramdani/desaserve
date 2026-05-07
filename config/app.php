<?php

return [
    'name' => getenv('APP_NAME') ?: 'DesaServe',
    'base_url' => getenv('APP_BASE_URL') ?: 'http://localhost:8080',
    'asset_base_url' => getenv('ASSET_BASE_URL') ?: '',
];
