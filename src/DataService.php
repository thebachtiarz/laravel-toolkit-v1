<?php

namespace TheBachtiarz\Toolkit;

use TheBachtiarz\Toolkit\Config\Interfaces\Data\ToolkitConfigInterface;

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
            'app.name' => config(ToolkitInterface::TOOLKIT_CONFIG_NAME . '.' . ToolkitConfigInterface::TOOLKIT_CONFIG_APP_NAME_NAME),
            'app.url' => config(ToolkitInterface::TOOLKIT_CONFIG_NAME . '.' . ToolkitConfigInterface::TOOLKIT_CONFIG_APP_URL_NAME),
            'app.timezone' => config(ToolkitInterface::TOOLKIT_CONFIG_NAME . '.' . ToolkitConfigInterface::TOOLKIT_CONFIG_APP_TIMEZONE_NAME),
            'app.key' => config(ToolkitInterface::TOOLKIT_CONFIG_NAME . '.' . ToolkitConfigInterface::TOOLKIT_CONFIG_APP_KEY_NAME)
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
