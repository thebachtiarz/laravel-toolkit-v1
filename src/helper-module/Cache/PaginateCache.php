<?php

namespace TheBachtiarz\Toolkit\Helper\Cache;

use TheBachtiarz\Toolkit\Cache\Service\Cache;
use TheBachtiarz\Toolkit\Helper\Interfaces\Data\PaginateInterface;

class PaginateCache
{
    //

    /**
     * paginate page cache name
     *
     * @var string
     */
    private static string $paginatePageName = PaginateInterface::PAGINATE_PARAMS_PAGE_NAME;

    /**
     * paginate per page cache name
     *
     * @var string
     */
    private static string $paginatePerPageName = PaginateInterface::PAGINATE_PARAMS_PERPAGE_NAME;

    // ? Public method
    /**
     * reset paginate cache
     *
     * @return boolean
     */
    public static function reset(): bool
    {
        try {
            Cache::delete(PaginateInterface::PAGINATE_CONDITION_NAME);
            Cache::delete(self::$paginatePageName);
            Cache::delete(self::$paginatePerPageName);
            Cache::delete(PaginateInterface::PAGINATE_SUMMARY_INFO_NAME);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    // ?  Setter Module
    /**
     * check paginate condition
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

    /**
     * Set paginate condition to active
     *
     * @return self
     */
    public static function activatePaginate(): self
    {
        Cache::setTemporary(PaginateInterface::PAGINATE_CONDITION_NAME, true);

        return new self;
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

    /**
     * Set paginate summary info
     *
     * @param array $paginateSummaryInfo
     * @return self
     */
    public static function setPaginateSummaryInfo(array $paginateSummaryInfo): self
    {
        Cache::setTemporary(PaginateInterface::PAGINATE_SUMMARY_INFO_NAME, $paginateSummaryInfo);

        return new self;
    }
}
