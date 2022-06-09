<?php

namespace TheBachtiarz\Toolkit\Config\Service;

use TheBachtiarz\Toolkit\Config\Interfaces\Data\ToolkitConfigInterface;
use TheBachtiarz\Toolkit\Config\Job\ToolkitConfigJob;
use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;

class ToolkitConfigService
{
    use ErrorLogTrait;

    /**
     * Config name
     *
     * @var string
     */
    protected static string $name;

    /**
     * Config access group
     *
     * @var string
     */
    protected static string $accessGroup = ToolkitConfigInterface::TOOLKIT_CONFIG_PUBLIC_CODE;

    /**
     * Config is enable
     *
     * @var boolean
     */
    protected static bool $isEnable = true;

    /**
     * Config is encrypt
     *
     * @var boolean
     */
    protected static bool $isEncrypt = false;

    /**
     * Config value
     *
     * @var mixed
     */
    protected static mixed $value;

    // ? Public Methods
    /**
     * Get config service.
     * ! Require: name.
     * ? Extra: isEnable, accessGroup.
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
     * Set config service.
     * ! Require: name, value.
     * ? Extra: isEncrypt, accessGroup.
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
     * Delete config service.
     * ! Require: name.
     * ? Extra: accessGroup.
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
     * Create arguments
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
