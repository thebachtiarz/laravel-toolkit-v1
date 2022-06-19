<?php

namespace TheBachtiarz\Toolkit\Console\Service;

use TheBachtiarz\Toolkit\Cache\Service\Cache;

/**
 * This class is used for keeping your caches when you doing cache clean.
 * But still want to keep some of caches.
 */
class KeepCacheService
{
    /**
     * Keep cache(s) based on name
     *
     * @var array
     */
    private static array $keepCacheName = [];

    /**
     * Temporary cache data
     *
     * @var array
     */
    private static array $cacheDataBackup = [];

    // ? Public Methods
    /**
     * Process to backup cache data into temporary data
     *
     * @return static
     */
    public static function backupCache(): static
    {
        try {
            if (count(static::$keepCacheName)) {
                $_temporaries = [];

                foreach (static::$keepCacheName as $key => $cacheName)
                    if (Cache::has($cacheName))
                        $_temporaries[] = [$cacheName => Cache::get($cacheName)];

                self::$cacheDataBackup = $_temporaries;
            }
        } catch (\Throwable $th) {
        } finally {
            return new static;
        }
    }

    /**
     * Process to restore temporary cache data into cache storage
     *
     * @return boolean
     */
    public static function restoreCache(): bool
    {
        $result = false;

        try {
            if (count(static::$cacheDataBackup))
                foreach (static::$cacheDataBackup as $key => $temporaryCache)
                    Cache::set(key($temporaryCache), $temporaryCache[key($temporaryCache)]);

            $result = true;
        } catch (\Throwable $th) {
        } finally {
            return $result;
        }
    }

    // ? Private Methods

    // ? Setter Modules
    /**
     * Set keep cache name
     *
     * @param array $keepCacheName
     * @return static
     */
    public static function setKeepCacheName(array $keepCacheName): static
    {
        self::$keepCacheName = $keepCacheName;

        return new static;
    }
}
