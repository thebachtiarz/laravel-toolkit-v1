<?php

namespace TheBachtiarz\Toolkit\Config\Service;

use Illuminate\Support\Facades\Log;
use TheBachtiarz\Toolkit\Config\Interfaces\Data\ToolkitConfigInterface;
use TheBachtiarz\Toolkit\Config\Job\ToolkitConfigJob;

class ToolkitConfigService
{
    private static string $name;
    private static string $accessGroup = ToolkitConfigInterface::TOOLKIT_CONFIG_PUBLIC_CODE;
    private static bool $isEnable = true;
    private static bool $isEncrypt = false;
    private static $value;

    // ? Public Methods
    /**
     * get config service
     *
     * ! require: name
     *
     * ? extra: isEnable, accessGroup
     *
     * @return mixed|null
     */
    public static function get()
    {
        try {
            return ToolkitConfigJob::get(
                ...self::arguments([
                    'name', 'isEnable', 'accessGroup'
                ])
            );
        } catch (\Throwable $th) {
            Log::channel('error')->error($th->getMessage());
            return null;
        }
    }

    /**
     * set config service
     *
     * ! require: name, value
     *
     * ? extra: isEncrypt, accessGroup
     *
     * @return boolean
     */
    public static function set(): bool
    {
        try {
            return (bool) ToolkitConfigJob::set(
                ...self::arguments([
                    'name', 'value', 'isEncrypt', 'accessGroup'
                ])
            );
        } catch (\Throwable $th) {
            Log::channel('error')->error($th->getMessage());
            return false;
        }
    }

    /**
     * delete config service
     *
     * ! require: name
     *
     * ? extra: accessGroup
     *
     * @return boolean
     */
    public static function delete(): bool
    {
        try {
            return (bool) ToolkitConfigJob::delete(
                ...self::arguments([
                    'name', 'accessGroup'
                ])
            );
        } catch (\Throwable $th) {
            Log::channel('error')->error($th->getMessage());
            return false;
        }
    }

    // ? Private Methods
    /**
     * create arguments
     *
     * @param array $arguments
     * @return array|null
     */
    private static function arguments(array $arguments): ?array
    {
        try {
            $args = [];

            foreach ($arguments as $key => $argument)
                $args[] = self::${$argument};

            return $args;
        } catch (\Throwable $th) {
            Log::channel('error')->error($th->getMessage());
            return null;
        }
    }

    // ? Setter Modules
    /**
     * set name
     *
     * @param string $name
     * @return self
     */
    public static function name(string $name): self
    {
        self::$name = $name;

        return new self;
    }

    /**
     * set access group
     *
     * @param string $accessGroup
     * @return self
     */
    public static function accessGroup(string $accessGroup): self
    {
        self::$accessGroup = $accessGroup;

        return new self;
    }

    /**
     * set is enable
     *
     * @param boolean $isEnable
     * @return self
     */
    public static function isEnable(bool $isEnable): self
    {
        self::$isEnable = $isEnable;

        return new self;
    }

    /**
     * set is encrypted
     *
     * @param boolean $isEncrypt
     * @return self
     */
    public static function isEncrypt(bool $isEncrypt): self
    {
        self::$isEncrypt = $isEncrypt;

        return new self;
    }

    /**
     * set value
     *
     * @param mixed $value
     * @return self
     */
    public static function value($value): self
    {
        self::$value = $value;

        return new self;
    }
}
