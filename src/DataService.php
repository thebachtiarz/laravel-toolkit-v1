<?php

namespace TheBachtiarz\Toolkit;

class DataService
{
    /**
     * list of config who need to registered into current project.
     * perform by toolkit app module.
     *
     * @return array
     */
    public static function registerConfig(): array
    {
        $registerConfig = [];

        // ! app
        $registerConfig[] = [
            'app.name' => config('thebachtiarz_toolkit.app_name'),
            'app.key' => config('thebachtiarz_toolkit.app_key'),
            'app.url' => config('thebachtiarz_toolkit.app_url'),
            'app.timezone' => config('thebachtiarz_toolkit.app_timezone')
        ];

        // ! cache
        $registerConfig[] = [
            'cache.default' => 'database'
        ];

        // ! logging
        $logging = config('logging.channels');
        $registerConfig[] = [
            'logging.channels' => array_merge(
                $logging,
                [
                    'application' => [
                        'driver' => 'single',
                        'path' => base_path('toolkit_application.log')
                    ],
                    'developer' => [
                        'driver' => 'single',
                        'path' => base_path('toolkit_developer.log')
                    ],
                    'error' => [
                        'driver' => 'single',
                        'level' => 'debug',
                        'path' => base_path('toolkit_error.log')
                    ],
                    'maintenance' => [
                        'driver' => 'single',
                        'path' => base_path('toolkit_maintenance.log')
                    ]
                ]
            )
        ];

        return $registerConfig;
    }
}
