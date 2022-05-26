<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | Here your application name are stored.
    |
    | ! this config is mutable !
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
    | ! this config is mutable !
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
    | ! this config is mutable !
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
    | ! this config is mutable !
    |
    */
    'app_key' => "",

    /*
    |--------------------------------------------------------------------------
    | Application Prefix
    |--------------------------------------------------------------------------
    |
    | Here your application url subfolder prefix are stored.
    | Where you have library who requires this library.
    |
    | ex: {{domain}}/{{thebachtiarz}}/---
    |
    | ! this config is mutable !
    |
    */
    'app_prefix' => "thebachtiarz",

    /*
    |--------------------------------------------------------------------------
    | Logger Mode Available
    |--------------------------------------------------------------------------
    |
    | Here you can specify the mode to allow the system to write logs.
    |
    */
    'logger_mode' => ["local", "developer"],

    /*
    |--------------------------------------------------------------------------
    | App Refresh Artisan Command Before
    |--------------------------------------------------------------------------
    |
    | This option will run artisan command when "artisan app:refresh" run.
    | Right after artisan down
    |
    */
    'app_refresh_artisan_commands_before' => [
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
    | App Refresh Artisan Command After
    |--------------------------------------------------------------------------
    |
    | This option will run artisan command when "artisan app:refresh" run.
    | Right before artisan up
    |
    */
    'app_refresh_artisan_commands_after' => [
        [
            'command' => 'config:cache',
            'message' => '- Configuration cached successfully!'
        ]
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
    | All classes must implementing interface:
    | -> TheBachtiarz\Toolkit\Config\Interfaces\Classes\ScheduleCacheInterface;
    |
    */
    'app_refresh_cache_classes' => []
];
