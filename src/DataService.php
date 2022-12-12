<?php

namespace TheBachtiarz\Toolkit;

use TheBachtiarz\Toolkit\Config\Interfaces\Data\ToolkitConfigInterface;

class DataService
{
    /**
     * List of config who need to registered into current project.
     * Perform by toolkit app module.
     *
     * @return array
     */
    public static function registerConfig(): array
    {
        $registerConfig = [];

        // ! App
        $registerConfig[] = [
            'app.name' => tbtoolkitconfig(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_NAME_NAME),
            'app.url' => tbtoolkitconfig(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_URL_NAME),
            'app.timezone' => tbtoolkitconfig(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_TIMEZONE_NAME),
            'app.key' => tbtoolkitconfig(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_KEY_NAME)
        ];
        $_providers = config('app.providers');
        $registerConfig[] = [
            'app.providers' => array_merge(
                $_providers,
                [
                    \TheBachtiarz\Toolkit\Backend\RouteServiceProvider::class
                ]
            )
        ];

        // ! Cache
        $registerConfig[] = [
            'cache.default' => 'database'
        ];

        // ! Cors paths
        $_paths = config('cors.paths');
        $registerConfig[] = [
            'cors.paths' => array_merge(
                $_paths,
                [tbtoolkitconfig('app_prefix') . '/*']
            )
        ];

        // ! Logging
        $logging = config('logging.channels');
        $registerConfig[] = [
            'logging.channels' => array_merge(
                $logging,
                [
                    'application' => [
                        'driver' => 'single',
                        'path' => tbdirlocation("log/application.log")
                    ],
                    'curl' => [
                        'driver' => 'single',
                        'path' => tbdirlocation("log/curl.log")
                    ],
                    'developer' => [
                        'driver' => 'single',
                        'path' => tbdirlocation("log/developer.log")
                    ],
                    'production' => [
                        'driver' => 'single',
                        'path' => tbdirlocation("log/production.log")
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
