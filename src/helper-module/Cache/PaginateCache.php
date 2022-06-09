<?php

namespace TheBachtiarz\Toolkit\Helper\Cache;

use TheBachtiarz\Toolkit\Cache\Service\Cache;
use TheBachtiarz\Toolkit\Helper\Interfaces\Data\PaginateInterface;

class PaginateCache
{
    //

    /**
     * Paginate page cache name
     *
     * @var string
     */
    private static string $paginatePageName = PaginateInterface::PAGINATE_PARAMS_PAGE_NAME;

    /**
     * Paginate per page cache name
     *
     * @var string
     */
    private static string $paginatePerPageName = PaginateInterface::PAGINATE_PARAMS_PERPAGE_NAME;

    // ? Public method
    /**
     * Reset paginate cache
     *
     * @return boolean
     */
    public static function reset(): bool
    {
        try {
            Cache::delete(PaginateInterface::PAGINATE_CONDITION_NAME);
            Cache::delete(static::$paginatePageName);
            Cache::delete(static::$paginatePerPageName);
            Cache::delete(PaginateInterface::PAGINATE_SUMMARY_INFO_NAME);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // ? Getter Module
    /**
     * Check paginate condition
     *
     * @return boolean
     */
    public static function isPaginateActive(): bool
    {
        return Cache::get(PaginateInterface::PAGINATE_CONDITION_NAME) ?? false;
    }

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
     * Get paginate summary info
     *
     * @return mixed
     */
    public static function getPaginateSummaryInfo(): mixed
    {
        return Cache::get(PaginateInterface::PAGINATE_SUMMARY_INFO_NAME);
    }

    // ? Setter Module
    /**
     * Set paginate condition to active
     *
     * @return static
     */
    public static function activatePaginate(): static
    {
        Cache::setTemporary(PaginateInterface::PAGINATE_CONDITION_NAME, true);

        return new static;
    }

    /**
     * Set page paginate cache
     *
     * @param mixed $paginatePage page paginate cache
     * @return static
     */
    public static function setPaginatePage(mixed $paginatePage = null): static
    {
        Cache::setTemporary(self::$paginatePageName, $paginatePage);

        return new static;
    }

    /**
     * Set per page paginate cache
     *
     * @param mixed $paginatePerPage per page paginate cache
     * @return static
     */
    public static function setPaginatePerPage(mixed $paginatePerPage = null): static
    {
        Cache::setTemporary(self::$paginatePerPageName, $paginatePerPage);

        return new static;
    }

    /**
     * Set paginate summary info
     *
     * @param array $paginateSummaryInfo
     * @return static
     */
    public static function setPaginateSummaryInfo(array $paginateSummaryInfo): static
    {
        Cache::setTemporary(PaginateInterface::PAGINATE_SUMMARY_INFO_NAME, $paginateSummaryInfo);

        return new static;
    }
}
