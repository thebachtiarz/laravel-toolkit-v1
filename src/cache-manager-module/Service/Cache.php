<?php

namespace TheBachtiarz\Toolkit\Cache\Service;

use Illuminate\Support\Facades\Cache as LaravelCache;

class Cache
{
    /**
     * check is cache available by key
     *
     * @param string $cacheName
     * @return boolean
     */
    public static function has(string $cacheName): bool
    {
        return LaravelCache::has($cacheName);
    }

    /**
     * get cache by key
     *
     * @param string $cacheName
     * @return mixed|null
     */
    public static function get(string $cacheName)
    {
        return LaravelCache::get($cacheName);
    }

    /**
     * set cache data forever
     *
     * @param string $cacheName
     * @param mixed $value
     * @return mixed|null
     */
    public static function set(string $cacheName, $value)
    {
        return LaravelCache::forever($cacheName, $value);
    }

    /**
     * set cache data temporary with time to live
     *
     * @param string $cacheName
     * @param mixed $value
     * @param integer $ttl timestamps
     * @return mixed
     */
    public static function setTemporary(string $cacheName, $value, int $ttl)
    {
        return LaravelCache::add($cacheName, $value, $ttl);
    }

    /**
     * delete a cache data by key
     *
     * @param string $cacheName
     * @return boolean
     */
    public static function delete(string $cacheName): bool
    {
        return LaravelCache::forget($cacheName);
    }

    /**
     * erase/remove all cache data
     *
     * @return boolean
     */
    public static function erase(): bool
    {
        return LaravelCache::flush();
    }
}
