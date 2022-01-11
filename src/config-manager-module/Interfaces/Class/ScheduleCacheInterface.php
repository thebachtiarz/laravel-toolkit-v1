<?php

namespace TheBachtiarz\Toolkit\Config\Interfaces\Class;

interface ScheduleCacheInterface
{
    /**
     * cache process schedule service
     *
     * @return boolean
     */
    public static function process(): bool;
}
