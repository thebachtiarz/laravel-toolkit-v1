<?php

namespace TheBachtiarz\Toolkit\Cache\Base;

use TheBachtiarz\Toolkit\Cache\Interfaces\Data\ApplicationDataInterface;
use TheBachtiarz\Toolkit\Cache\Service\Cache as ToolkitCache;

class Cache
{
    /**
     * cache app key
     *
     * @return string
     */
    public static function appKey(): string
    {
        return ToolkitCache::get(ApplicationDataInterface::TOOLKIT_APP_KEY_CACHE_NAME);
    }
}
