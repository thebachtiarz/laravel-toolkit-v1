<?php

namespace TheBachtiarz\Toolkit;

class ApplicationToolkitService
{
    /**
     * List of commands from toolkit modules
     */
    public const COMMANDS = [
        \TheBachtiarz\Toolkit\Console\Commands\AppRefreshCommand::class,
        \TheBachtiarz\Toolkit\Console\Commands\DatabaseBackupCommand::class,
        \TheBachtiarz\Toolkit\Console\Commands\KeyGenerateCommand::class,
        \TheBachtiarz\Toolkit\Console\Commands\LoggerBackupCommand::class
    ];

    // ? Public Methods
    /**
     * Register config
     *
     * @return boolean
     */
    public function registerConfig(): bool
    {
        try {
            $this->createDirectories();
            $this->setConfigs();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Register commands
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
     * Create directories
     *
     * @return void
     */
    private function createDirectories(): void
    {
        if (!is_dir(tbdirlocation()))
            mkdir(tbdirlocation(), 0755);

        if (!is_dir(tbdirlocation("backup/log")))
            mkdir(tbdirlocation("backup/log"), 0755, true);

        if (!is_dir(tbdirlocation("backup/database")))
            mkdir(tbdirlocation("backup/database"), 0755, true);
    }

    /**
     * Set configs
     *
     * @return void
     */
    private function setConfigs(): void
    {
        foreach (DataService::registerConfig() as $key => $register)
            config($register);
    }
}
