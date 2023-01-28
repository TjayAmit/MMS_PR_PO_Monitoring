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

    // sanctum/csrf-cookie
    'allow_credentials'=> true,

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'auth/*',],

    'allowed_methods' => ['PUT,DELETE,POST,GET,OPTIONS','*'],

    'allowed_origins' => ['http://localhost:3000',"htt://192.168.13.232:3000",'*'],

    'allowed_origins_patterns' => [], 

    'allowed_headers' => ["Accept, Authorization, Content-Type",'*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
