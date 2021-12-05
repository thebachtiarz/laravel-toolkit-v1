<?php

namespace TheBachtiarz\Toolkit\Cache\Base;

use TheBachtiarz\Toolkit\Cache\Service\Cache as ToolkitCache;
use TheBachtiarz\Toolkit\Config\Interfaces\Data\ToolkitConfigInterface;

class Cache
{
    /**
     * cache app key
     *
     * @return string
     */
    public static function appKey(): string
    {
        return ToolkitCache::get(ToolkitConfigInterface::TOOLKIT_CONFIG_APP_KEY_NAME);
    }
}
