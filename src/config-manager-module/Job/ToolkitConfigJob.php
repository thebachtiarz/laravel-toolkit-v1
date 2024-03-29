<?php

namespace TheBachtiarz\Toolkit\Config\Job;

use TheBachtiarz\Toolkit\Config\Interfaces\Data\ToolkitConfigInterface;
use TheBachtiarz\Toolkit\Config\Model\ToolkitConfig;
use TheBachtiarz\Toolkit\Helper\App\Converter\ArrayHelper;
use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;

class ToolkitConfigJob
{
    use ArrayHelper, ErrorLogTrait;

    // ? Public Methods
    /**
     * Get config data
     *
     * @param string $name
     * @param boolean $is_enable
     * @param string $access_group
     * @return mixed
     */
    public static function get(
        string $name,
        bool $is_enable = true,
        string $access_group = ToolkitConfigInterface::TOOLKIT_CONFIG_PUBLIC_CODE
    ): mixed {
        try {
            $config = self::getConfigData($name, $is_enable, $access_group);
            throw_if(!$config, 'Exception', "config not found");

            return self::unserializeConfig($config->value, $config->is_encrypt);
        } catch (\Throwable $th) {
            self::logCatch($th);

            return null;
        }
    }

    /**
     * Set config data
     *
     * @param string $name
     * @param mixed $value
     * @param boolean $is_encrypt
     * @param string $access_group
     * @return ToolkitConfig|null
     */
    public static function set(
        string $name,
        mixed $value,
        bool $is_encrypt = false,
        string $access_group = ToolkitConfigInterface::TOOLKIT_CONFIG_PUBLIC_CODE
    ): ?ToolkitConfig {
        try {
            return self::setConfigData(
                $name,
                self::serializeConfig($value, $is_encrypt),
                $is_encrypt,
                $access_group
            );
        } catch (\Throwable $th) {
            self::logCatch($th);

            return null;
        }
    }

    /**
     * Delete config data
     *
     * @param string $name
     * @param string $access_group
     * @return boolean|null
     */
    public static function delete(
        string $name,
        string $access_group = ToolkitConfigInterface::TOOLKIT_CONFIG_PUBLIC_CODE
    ): ?bool {
        try {
            return self::deleteConfigData($name, $access_group);
        } catch (\Throwable $th) {
            self::logCatch($th);

            return null;
        }
    }

    // ? Private Methods
    /**
     * Get config data
     *
     * @param string $name
     * @param boolean $is_enable
     * @param string $access_group
     * @return ToolkitConfig|null
     */
    private static function getConfigData(
        string $name,
        bool $is_enable = true,
        string $access_group = ToolkitConfigInterface::TOOLKIT_CONFIG_PUBLIC_CODE
    ): ?ToolkitConfig {
        try {
            return ToolkitConfig::where([
                ['name', $name],
                ['is_enable', $is_enable],
                ['access_group', $access_group]
            ])->first();
        } catch (\Throwable $th) {
            self::logCatch($th);

            return null;
        }
    }

    /**
     * Set config data
     *
     * @param string $name
     * @param string $value
     * @param boolean $is_encrypt
     * @param string $access_group
     * @return ToolkitConfig|null
     */
    private static function setConfigData(
        string $name,
        string $value,
        bool $is_encrypt = false,
        string $access_group = ToolkitConfigInterface::TOOLKIT_CONFIG_PUBLIC_CODE
    ): ?ToolkitConfig {
        try {
            return ToolkitConfig::updateOrCreate(
                ['name' => $name, 'access_group' => $access_group],
                ['is_encrypt' => $is_encrypt, 'value' => $value]
            );
        } catch (\Throwable $th) {
            self::logCatch($th);

            return null;
        }
    }

    /**
     * Delete config data
     *
     * @param string $name
     * @param string $access_group
     * @return boolean
     */
    private static function deleteConfigData(
        string $name,
        string $access_group = ToolkitConfigInterface::TOOLKIT_CONFIG_PUBLIC_CODE
    ): bool {
        try {
            return ToolkitConfig::where([
                'name' => $name,
                'access_group' => $access_group
            ])->delete();
        } catch (\Throwable $th) {
            self::logCatch($th);

            return false;
        }
    }

    /**
     * Serialize config value
     *
     * @param mixed $value
     * @param boolean $is_encrypt
     * @return string|null
     */
    private static function serializeConfig($value, bool $is_encrypt = false): ?string
    {
        try {
            if ($is_encrypt)
                $value = encrypt($value);

            return self::serialize($value);
        } catch (\Throwable $th) {
            self::logCatch($th);

            return null;
        }
    }

    /**
     * Unserialize config value
     *
     * @param string $value
     * @param boolean $is_encrypt
     * @return mixed
     */
    private static function unserializeConfig(string $value, bool $is_encrypt = false): mixed
    {
        try {
            $config = self::unserialize($value);

            if ($is_encrypt)
                $config = decrypt($config);

            return $config;
        } catch (\Throwable $th) {
            self::logCatch($th);

            return null;
        }
    }

    // ? Setter Modules
}
