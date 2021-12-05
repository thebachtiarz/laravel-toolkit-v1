<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | Here your application name are stored.
    |
    */
    'app_name' => "",

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | Here your application url are stored.
    |
    */
    'app_url' => "",

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here your application timezone are stored.
    | @see \DateTimeZone::listIdentifiers()
    |
    */
    'app_timezone' => "",

    /*
    |--------------------------------------------------------------------------
    | Application Key
    |--------------------------------------------------------------------------
    |
    | Here your application key are stored.
    |
    */
    'app_key' => "",

    /*
    |--------------------------------------------------------------------------
    | App Refresh Artisan Command
    |--------------------------------------------------------------------------
    |
    | This option will run artisan command when "artisan app:refresh" run.
    |
    */
    'app_refresh_artisan_commands' => [
        [
            'command' => 'view:clear',
            'message' => '- Compiled views cleared!'
        ], [
            'command' => 'config:clear',
            'message' => '- Configuration cache cleared!'
        ], [
            'command' => 'cache:clear',
            'message' => '- Application cache cleared!'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | App Refresh Cache Class
    |--------------------------------------------------------------------------
    |
    | This option will run cache service classes when "artisan app:refresh" run
    | make sure there is a method named "process" inside the class
    | otherwise will return an error message.
    |
    |
    */
    'app_refresh_cache_classes' => []
];
