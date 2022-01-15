<?php

namespace TheBachtiarz\Toolkit;

use TheBachtiarz\Toolkit\Console\Commands\{AppRefreshCommand, KeyGenerateCommand};

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
            $this->createDirectories();
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
     * create directories
     *
     * @return void
     */
    private function createDirectories(): void
    {
        if (!is_dir(base_path(ToolkitInterface::TOOLKIT_DIRECTORY_PATH)))
            mkdir(base_path(ToolkitInterface::TOOLKIT_DIRECTORY_PATH), 0755);
    }

    /**
     * set configs
     *
     * @return void
     */
    private function setConfigs(): void
    {
        foreach (DataService::registerConfig() as $key => $register)
            config($register);
    }
}
