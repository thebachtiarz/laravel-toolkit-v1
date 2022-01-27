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
            'app.name' => tbtoolkitconfig(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_NAME_NAME),
            'app.url' => tbtoolkitconfig(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_URL_NAME),
            'app.timezone' => tbtoolkitconfig(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_TIMEZONE_NAME),
            'app.key' => tbtoolkitconfig(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_KEY_NAME)
        ];

        // ! cache
        $registerConfig[] = [
            'cache.default' => 'database'
        ];

        // ! cors paths
        $_paths = config('cors.paths');
        $registerConfig[] = [
            'cors.paths' => array_merge(
                $_paths,
                [tbtoolkitconfig('app_prefix') . '/*']
            )
        ];

        // ! logging
        $logging = config('logging.channels');
        $registerConfig[] = [
            'logging.channels' => array_merge(
                $logging,
                [
                    'application' => [
                        'driver' => 'single',
                        'path' => tbdirlocation("log/application.log")
                    ],
                    'developer' => [
                        'driver' => 'single',
                        'path' => tbdirlocation("log/developer.log")
                    ],
                    'error' => [
                        'driver' => 'single',
                        'level' => 'debug',
                        'path' => tbdirlocation("log/error.log")
                    ],
                    'maintenance' => [
                        'driver' => 'single',
                        'path' => tbdirlocation("log/maintenance.log")
                    ]
                ]
            )
        ];

        return $registerConfig;
    }
}
