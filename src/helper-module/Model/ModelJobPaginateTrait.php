<?php

namespace TheBachtiarz\Toolkit\Helper\Model;

use TheBachtiarz\Toolkit\Helper\Cache\PaginateCache;

/**
 * Model Job Paginate Trait
 */
trait ModelJobPaginateTrait
{
    //

    /**
     * list paginate page
     *
     * @var integer|null
     */
    protected static ?int $paginatePage = 1;

    /**
     * list paginate per page
     *
     * @var integer|null
     */
    protected static ?int $paginatePerPage = 10;

    // ? Public Methods

    // ? Private Methods
    /**
     * create simple paginate
     *
     * @param string $class
     * @return object
     * @throws \Throwable
     */
    private static function paginateSimple(string $class): object
    {
        try {
            throw_if(!class_exists($class), 'Exception', sprintf("Class %s not exist", $class));

            return $class::simplePaginate(
                perPage: PaginateCache::getPaginatePerPage() ?: self::$paginatePerPage,
                page: PaginateCache::getPaginatePage() ?: self::$paginatePage
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // ? Setter Modules
    /**
     * Set paginate data
     *
     * @param integer|null $perPage finance list paginate per page
     * @param integer|null $page finance list paginate pointer page
     * @return self
     */
    public static function setPaginate(?int $perPage = null, ?int $page = null): self
    {
        self::$paginatePerPage = $perPage ?: self::$paginatePerPage;

        self::$paginatePage = $page ?: self::$paginatePage;

        return new self;
    }
}
