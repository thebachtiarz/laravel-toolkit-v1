<?php

return [
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
