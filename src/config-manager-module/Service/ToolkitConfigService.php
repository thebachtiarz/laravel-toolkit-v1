<?php

namespace TheBachtiarz\Toolkit\Config\Service;

use Illuminate\Support\Facades\Log;
use TheBachtiarz\Toolkit\Config\Job\ToolkitConfigJob;

class ToolkitConfigService
{
    //
    private $_aaa = [
        'name',
        'access_group',
        'is_enable',
        'is_encrypt',
        'value'
    ];

    private static ?string $name = null;
    private static ?string $accessGroup = null;
    private static ?bool $isEnable = null;
    private static ?bool $isEncrypt = null;
    private static ?mixed $value = null;

    // ? Public Methods
    public static function get(): ?string
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
                if (self::${$argument})
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
    public static function setName(string $name): self
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
    public static function setAccessGroup(string $accessGroup): self
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
    public static function setValue($value): self
    {
        self::$value = $value;

        return new self;
    }
}
