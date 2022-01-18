<?php

namespace TheBachtiarz\Toolkit\Config\Helper;

use Illuminate\Support\Facades\Log;
use TheBachtiarz\Toolkit\ToolkitInterface;

trait ConfigHelper
{
    /**
     * config name.
     * default: thebachtiarz_toolkit
     *
     * @var string
     */
    private static string $configName = ToolkitInterface::TOOLKIT_CONFIG_NAME;

    /**
     * update config file value
     *
     * @param string $key
     * @param string $value
     * @return boolean
     */
    private static function updateConfigFile(string $key, string $value): bool
    {
        return self::replaceToolkitConfigFile([
            [
                'key' => $key,
                'old' => config(self::$configName . ".{$key}"),
                'new' => $value,
                'tag_value' => '"'
            ]
        ]);
    }

    /**
     * replace file config static value
     *
     * sample : [['key' => 'app_key', 'old' => config('thebachtiarz_toolkit.app_key'), 'new' => $newKey, 'tag_value' => '"']]
     *
     * @param array $replaces
     * @return boolean
     */
    private static function replaceToolkitConfigFile(array $replaces = []): bool
    {
        try {
            $configPath = config_path(self::$configName . ".php");
            $_isFileExist = file_exists($configPath);
            if ($_isFileExist) {
                foreach ($replaces as $key => $replace) {
                    file_put_contents(
                        $configPath,
                        str_replace(
                            "'{$replace['key']}' => {$replace['tag_value']}{$replace['old']}{$replace['tag_value']}",
                            "'{$replace['key']}' => {$replace['tag_value']}{$replace['new']}{$replace['tag_value']}",
                            file_get_contents($configPath)
                        )
                    );
                }
            }

            return true;
        } catch (\Throwable $th) {
            Log::channel('error')->error($th->getMessage());

            return false;
        }
    }

    // ? Setter Modules
    /**
     * Set config name
     *
     * @param string $configName default: thebachtiarz_toolkit
     * @return self
     */
    private static function setConfigName(string $configName = ToolkitInterface::TOOLKIT_CONFIG_NAME): self
    {
        self::$configName = $configName;

        return new self;
    }
}
