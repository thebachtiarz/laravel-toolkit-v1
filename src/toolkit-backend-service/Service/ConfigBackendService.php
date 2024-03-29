<?php

namespace TheBachtiarz\Toolkit\Backend\Service;

use TheBachtiarz\Toolkit\Config\Helper\ConfigHelper;
use TheBachtiarz\Toolkit\Config\Interfaces\Data\ToolkitConfigInterface;
use TheBachtiarz\Toolkit\Config\Service\ToolkitConfigService;
use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;

class ConfigBackendService
{
    use ErrorLogTrait;

    // ? Public Methods
    /**
     * Get config app name
     *
     * @return string|null
     */
    public static function getAppName(): ?string
    {
        return self::getConfigValue(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_NAME_NAME);
    }

    /**
     * Get config app url
     *
     * @return string|null
     */
    public static function getAppUrl(): ?string
    {
        return self::getConfigValue(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_URL_NAME);
    }

    /**
     * Get config app timezone
     *
     * @return string|null
     */
    public static function getAppTimezone(): ?string
    {
        return self::getConfigValue(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_TIMEZONE_NAME);
    }

    /**
     * Get config app prefix
     *
     * @return string|null
     */
    public static function getAppPrefix(): ?string
    {
        return self::getConfigValue(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_PREFIX_NAME);
    }

    /**
     * Set config app name
     *
     * @param string $appName
     * @return string|null
     */
    public static function setAppName(string $appName): ?string
    {
        try {
            $setAppNameData = self::setConfigDataTemplate(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_NAME_NAME, $appName, "app name");

            throw_if(!$setAppNameData['status'], 'Exception', $setAppNameData['message']);

            return self::getAppName();
        } catch (\Throwable $th) {
            self::logCatch($th);

            return null;
        }
    }

    /**
     * Set config app url
     *
     * @param string $appUrl
     * @return string|null
     */
    public static function setAppUrl(string $appUrl): ?string
    {
        try {
            $setAppUrlData = self::setConfigDataTemplate(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_URL_NAME, $appUrl, "app url");

            throw_if(!$setAppUrlData['status'], 'Exception', $setAppUrlData['message']);

            return self::getAppUrl();
        } catch (\Throwable $th) {
            self::logCatch($th);

            return null;
        }
    }

    /**
     * Set config app timezone
     *
     * @param string $appTimezone
     * @return string|null
     */
    public static function setAppTimezone(string $appTimezone): ?string
    {
        try {
            $setAppTimezoneData = self::setConfigDataTemplate(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_TIMEZONE_NAME, $appTimezone, "app timezone");

            throw_if(!$setAppTimezoneData['status'], 'Exception', $setAppTimezoneData['message']);

            return self::getAppTimezone();
        } catch (\Throwable $th) {
            self::logCatch($th);

            return null;
        }
    }

    /**
     * Set config app prefix
     *
     * @param string $appPrefix
     * @return string|null
     */
    public static function setAppPrefix(string $appPrefix): ?string
    {
        try {
            $setAppPrefixData = self::setConfigDataTemplate(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_PREFIX_NAME, $appPrefix, "app prefix");

            throw_if(!$setAppPrefixData['status'], 'Exception', $setAppPrefixData['message']);

            return self::getAppPrefix();
        } catch (\Throwable $th) {
            self::logCatch($th);

            return null;
        }
    }

    // ? Private Methods
    /**
     * Config data template setter
     *
     * @param string $key
     * @param string $value
     * @param string $message
     * @return array
     */
    private static function setConfigDataTemplate(string $key, string $value, string $message): array
    {
        $result = ['status' => false, 'message' => ''];

        try {
            $setConfigCache = self::setConfigValue($key, $value);

            throw_if(!$setConfigCache, 'Exception', "Failed to set {$message}");

            $updateConfigFile = ConfigHelper::updateConfigFile($key, $value);

            throw_if(!$updateConfigFile, 'Exception', "Failed to update config {$message} file");

            $result['status'] = true;
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
        } finally {
            return $result;
        }
    }

    /**
     * Get config value
     *
     * @param string $configName
     * @return mixed
     */
    private static function getConfigValue(string $configName)
    {
        return ToolkitConfigService::name(ToolkitConfigInterface::TOOLKIT_CONFIG_PREFIX_NAME . "/{$configName}")
            ->accessGroup(ToolkitConfigInterface::TOOLKIT_CONFIG_PRIVATE_CODE)
            ->get();
    }

    /**
     * Set config value
     *
     * @param string $configName
     * @param mixed $configValue
     * @return boolean|null
     */
    private static function setConfigValue(string $configName, $configValue): ?bool
    {
        return ToolkitConfigService::name(ToolkitConfigInterface::TOOLKIT_CONFIG_PREFIX_NAME . "/{$configName}")
            ->value($configValue)
            ->accessGroup(ToolkitConfigInterface::TOOLKIT_CONFIG_PRIVATE_CODE)
            ->set();
    }

    // ? Setter Modules
}
