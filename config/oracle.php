<?php

return [
    'oracle' => [
        'driver' => 'oracle',
        'service_name' => env('ORACLE_SERVICE_NAME', ''),
        'host' => env('ORACLE_HOST', ''),
        'port' => env('ORACLE_PORT', '1521'),
        'database' => env('ORACLE_DATABASE', ''),
        'username' => env('ORACLE_USERNAME', ''),
        'password' => env('ORACLE_PASSWORD', ''),
        'charset' => env('ORACLE_CHARSET', 'AL32UTF8'),
        'prefix' => env('ORACLE_PREFIX', ''),
    ],
];
