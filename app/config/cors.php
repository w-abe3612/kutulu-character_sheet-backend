<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    //'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['GET, POST'],

    'allowed_origins' => ['*'],
    //'allowed_origins' => ['https://chara-bako.com','https://*.chara-bako.com'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],
    //'allowed_headers' => ['Accept, X-Requested-With, Origin, Content-Type'],

    'exposed_headers' => [],

    'max_age' => false,

    'supports_credentials' => true,

];
