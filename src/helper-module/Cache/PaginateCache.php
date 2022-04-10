<?php

namespace TheBachtiarz\Toolkit\Helper\Cache;

use TheBachtiarz\Toolkit\Cache\Service\Cache;

class PaginateCache
{
    //

    /**
     * paginate page cache name
     *
     * @var string
     */
    private static string $paginatePageName = '__paginatePage';

    /**
     * paginate per page cache name
     *
     * @var string
     */
    private static string $paginatePerPageName = '__paginatePerPage';

    // ? Public method
    /**
     * reset paginate cache
     *
     * @return boolean
     */
    public static function reset(): bool
    {
        try {
            Cache::delete(self::$paginatePageName);
            Cache::delete(self::$paginatePerPageName);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // ?  Setter Module
    /**
     * Get page paginate cache
     *
     * @return mixed
     */
    public static function getPaginatePage(): mixed
    {
        return Cache::get(self::$paginatePageName);
    }

    /**
     * Get per page paginate cache
     *
     * @return mixed
     */
    public static function getPaginatePerPage(): mixed
    {
        return Cache::get(self::$paginatePerPageName);
    }

    /**
     * Set page paginate cache
     *
     * @param mixed $paginatePage page paginate cache
     * @return self
     */
    public static function setPaginatePage(mixed $paginatePage = null): self
    {
        Cache::setTemporary(self::$paginatePageName, $paginatePage);

        return new self;
    }

    /**
     * Set per page paginate cache
     *
     * @param mixed $paginatePerPage per page paginate cache
     * @return self
     */
    public static function setPaginatePerPage(mixed $paginatePerPage = null): self
    {
        Cache::setTemporary(self::$paginatePerPageName, $paginatePerPage);

        return new self;
    }
}
