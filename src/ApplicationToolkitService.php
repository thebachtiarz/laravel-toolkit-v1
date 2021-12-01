<?php

namespace TheBachtiarz\Toolkit;

use TheBachtiarz\Toolkit\Console\Commands\AppRefreshCommand;
use TheBachtiarz\Toolkit\Console\Commands\KeyGenerateCommand;

class ApplicationToolkitService
{
    /**
     * list of commands from toolkit modules
     */
    public const COMMANDS = [
        AppRefreshCommand::class,
        KeyGenerateCommand::class
    ];

    // ? Public Methods
    /**
     * register config
     *
     * @return boolean
     */
    public function registerConfig(): bool
    {
        try {
            $this->setConfigs();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * register commands
     *
     * @return array
     */
    public function registerCommands(): array
    {
        try {
            return self::COMMANDS;
        } catch (\Throwable $th) {
            return [];
        }
    }

    // ? Private Methods
    /**
     * set configs
     *
     * @return void
     */
    private function setConfigs(): void
    {
        // ! cache
        config([
            'cache.default' => 'database'
        ]);

        // ! logging
        $logging = config('logging.channels');
        config([
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
                    'maintenance' => [
                        'driver' => 'single',
                        'path' => base_path('toolkit_schedule.log')
                    ]
                ]
            )
        ]);
    }
}
