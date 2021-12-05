<?php

namespace TheBachtiarz\Toolkit\Backend\Service;

use Illuminate\Support\Facades\Log;
use TheBachtiarz\Toolkit\Config\Helper\ConfigHelper;
use TheBachtiarz\Toolkit\Config\Interfaces\Data\ToolkitConfigInterface;
use TheBachtiarz\Toolkit\Config\Service\ToolkitConfigService;
use TheBachtiarz\Toolkit\ToolkitInterface;

class ConfigBackendService
{
    use ConfigHelper;

    // ? Public Methods
    /**
     * get config app name
     *
     * @return string|null
     */
    public static function getAppName(): ?string
    {
        return self::getConfigValue(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_NAME_NAME);
    }

    /**
     * get config app url
     *
     * @return string|null
     */
    public static function getAppUrl(): ?string
    {
        return self::getConfigValue(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_URL_NAME);
    }

    /**
     * get config app timezone
     *
     * @return string|null
     */
    public static function getAppTimezone(): ?string
    {
        return self::getConfigValue(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_TIMEZONE_NAME);
    }

    /**
     * set config app name
     *
     * @param string $appName
     * @return string|null
     */
    public static function setAppName(string $appName): ?string
    {
        try {
            $setAppName = self::setConfigValue(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_NAME_NAME, $appName);

            throw_if(!$setAppName, 'Exception', "Failed to set app name");

            self::replaceToolkitConfigFile([
                [
                    'key' => ToolkitConfigInterface::TOOLKIT_CONFIG_APP_NAME_NAME,
                    'old' => config(ToolkitInterface::TOOLKIT_CONFIG_NAME . '.' . ToolkitConfigInterface::TOOLKIT_CONFIG_APP_NAME_NAME),
                    'new' => $appName,
                    'tag_value' => '"'
                ]
            ]);

            return self::getAppName();
        } catch (\Throwable $th) {
            Log::channel('error')->error($th->getMessage());
            return null;
        }
    }

    /**
     * set config app url
     *
     * @param string $appUrl
     * @return string|null
     */
    public static function setAppUrl(string $appUrl): ?string
    {
        try {
            $setAppUrl = self::setConfigValue(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_URL_NAME, $appUrl);

            throw_if(!$setAppUrl, 'Exception', "Failed to set app url");

            self::replaceToolkitConfigFile([
                [
                    'key' => ToolkitConfigInterface::TOOLKIT_CONFIG_APP_URL_NAME,
                    'old' => config(ToolkitInterface::TOOLKIT_CONFIG_NAME . '.' . ToolkitConfigInterface::TOOLKIT_CONFIG_APP_URL_NAME),
                    'new' => $appUrl,
                    'tag_value' => '"'
                ]
            ]);

            return self::getAppUrl();
        } catch (\Throwable $th) {
            Log::channel('error')->error($th->getMessage());
            return null;
        }
    }

    /**
     * set config app timezone
     *
     * @param string $appTimezone
     * @return string|null
     */
    public static function setAppTimezone(string $appTimezone): ?string
    {
        try {
            $setAppTimezone = self::setConfigValue(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_TIMEZONE_NAME, $appTimezone);

            throw_if(!$setAppTimezone, 'Exception', "Failed to set app timezone");

            self::replaceToolkitConfigFile([
                [
                    'key' => ToolkitConfigInterface::TOOLKIT_CONFIG_APP_TIMEZONE_NAME,
                    'old' => config(ToolkitInterface::TOOLKIT_CONFIG_NAME . '.' . ToolkitConfigInterface::TOOLKIT_CONFIG_APP_TIMEZONE_NAME),
                    'new' => $appTimezone,
                    'tag_value' => '"'
                ]
            ]);

            return self::getAppTimezone();
        } catch (\Throwable $th) {
            Log::channel('error')->error($th->getMessage());
            return null;
        }
    }

    // ? Private Methods
    /**
     * get config value
     *
     * @param string $configName
     * @return mixed|null
     */
    private static function getConfigValue(string $configName)
    {
        return ToolkitConfigService::name($configName)
            ->accessGroup(ToolkitConfigInterface::TOOLKIT_CONFIG_PRIVATE_CODE)
            ->get();
    }

    /**
     * set config value
     *
     * @param string $configName
     * @param mixed $configValue
     * @return boolean|null
     */
    private static function setConfigValue(string $configName, $configValue): ?bool
    {
        return ToolkitConfigService::name($configName)->value($configValue)
            ->accessGroup(ToolkitConfigInterface::TOOLKIT_CONFIG_PRIVATE_CODE)
            ->set();
    }

    // ? Setter Modules
}
