<?php

namespace TheBachtiarz\Toolkit\Console\Service;

use TheBachtiarz\Toolkit\Cache\Service\Cache as CacheService;

/**
 * this class is used for keeping your caches when you doing cache clean
 * but still want to keep some of caches
 */
class KeepCacheService
{
    private static array $keepCacheName = [];

    /**
     * your temporary cache data is stored here
     *
     * @var array
     */
    private static array $cacheDataBackup = [];

    // ? Public Methods
    /**
     * process to backup cache data into temporary data
     *
     * @return self
     */
    public static function backupCache(): self
    {
        try {
            if (count(self::$keepCacheName)) {
                $_temporaries = [];

                foreach (self::$keepCacheName as $key => $cacheName) {
                    $_checkCacheData = CacheService::has($cacheName);

                    if ($_checkCacheData)
                        $_temporaries[] = [$cacheName => CacheService::get($cacheName)];
                }

                self::$cacheDataBackup = $_temporaries;
            }
        } catch (\Throwable $th) {
            //
        } finally {
            return new self;
        }
    }

    /**
     * process to restore temporary cache data into cache storage
     *
     * @return boolean
     */
    public static function restoreCache(): bool
    {
        $result = false;

        try {
            if (count(self::$cacheDataBackup))
                foreach (self::$cacheDataBackup as $key => $temporaryCache)
                    CacheService::set(key($temporaryCache), $temporaryCache[key($temporaryCache)]);

            $result = true;
        } catch (\Throwable $th) {
            //
        } finally {
            return $result;
        }
    }

    // ? Private Methods

    // ? Setter Modules
    /**
     * set keep cache name
     *
     * @param array $keepCacheName
     * @return self
     */
    public static function setKeepCacheName(array $keepCacheName): self
    {
        self::$keepCacheName = $keepCacheName;

        return new self;
    }
}
