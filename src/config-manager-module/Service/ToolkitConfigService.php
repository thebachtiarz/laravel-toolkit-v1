<?php

namespace TheBachtiarz\Toolkit\Config\Service;

use TheBachtiarz\Toolkit\Config\Interfaces\Data\ToolkitConfigInterface;
use TheBachtiarz\Toolkit\Config\Job\ToolkitConfigJob;
use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;

class ToolkitConfigService
{
    use ErrorLogTrait;

    /**
     * config name
     *
     * @var string
     */
    protected static string $name;

    /**
     * config access group
     *
     * @var string
     */
    protected static string $accessGroup = ToolkitConfigInterface::TOOLKIT_CONFIG_PUBLIC_CODE;

    /**
     * config is enable
     *
     * @var boolean
     */
    protected static bool $isEnable = true;

    /**
     * config is encrypt
     *
     * @var boolean
     */
    protected static bool $isEncrypt = false;

    /**
     * config value
     *
     * @var mixed
     */
    protected static mixed $value;

    // ? Public Methods
    /**
     * get config service
     *
     * ! require: name
     *
     * ? extra: isEnable, accessGroup
     *
     * @return mixed
     */
    public static function get(): mixed
    {
        try {
            return ToolkitConfigJob::get(
                ...self::arguments([
                    'name', 'isEnable', 'accessGroup'
                ])
            );
        } catch (\Throwable $th) {
            self::logCatch($th);

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
            self::logCatch($th);

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
            self::logCatch($th);

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
            self::logCatch($th);

            return null;
        }
    }

    // ? Setter Modules
    /**
     * Set config name
     *
     * @param string $name config name
     * @return self
     */
    public static function name(string $name): self
    {
        self::$name = $name;

        return new self;
    }

    /**
     * Set config access group
     *
     * @param string $accessGroup config access group
     * @return self
     */
    public static function accessGroup(string $accessGroup): self
    {
        self::$accessGroup = $accessGroup;

        return new self;
    }

    /**
     * Set config is enable
     *
     * @param boolean $isEnable config is enable
     * @return self
     */
    public static function isEnable(bool $isEnable): self
    {
        self::$isEnable = $isEnable;

        return new self;
    }

    /**
     * Set config is encrypt
     *
     * @param boolean $isEncrypt config is encrypt
     * @return self
     */
    public static function isEncrypt(bool $isEncrypt): self
    {
        self::$isEncrypt = $isEncrypt;

        return new self;
    }

    /**
     * Set config value
     *
     * @param mixed $value config value
     * @return self
     */
    public static function value(mixed $value): self
    {
        self::$value = $value;

        return new self;
    }
}
