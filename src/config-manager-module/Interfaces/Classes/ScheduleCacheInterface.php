<?php

namespace TheBachtiarz\Toolkit\Config\Interfaces\Classes;

interface ScheduleCacheInterface
{
    /**
     * cache process schedule service
     *
     * @return boolean
     */
    public static function process(): bool;
}
