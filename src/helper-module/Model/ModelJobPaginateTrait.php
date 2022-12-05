<?php

namespace TheBachtiarz\Toolkit\Helper\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use TheBachtiarz\Toolkit\Helper\Cache\PaginateCache;
use TheBachtiarz\Toolkit\Helper\Interfaces\Data\PaginateInterface;

/**
 * Model Job Paginate Trait
 */
trait ModelJobPaginateTrait
{
    //

    /**
     * List paginate page
     *
     * @var integer|null
     */
    protected static ?int $paginatePage = PaginateInterface::PAGINATE_CONFIG_RESULT_DEFAULT_INIT_PAGE;

    /**
     * List paginate per page
     *
     * @var integer|null
     */
    protected static ?int $paginatePerPage = PaginateInterface::PAGINATE_CONFIG_RESULT_DEFAULT_INIT_PERPAGE;

    // ? Public Methods

    // ? Private Methods
    /**
     * Create simple paginate
     *
     * @param string $class
     * @return LengthAwarePaginator
     * @throws \Throwable
     */
    private static function paginateSimple(Model $model): LengthAwarePaginator
    {
        try {
            throw_if(!class_exists($model), 'Exception', sprintf("Class %s not exist", $model));

            PaginateCache::activatePaginate();

            $_result = $model::paginate(
                perPage: PaginateCache::getPaginatePerPage() ?: static::$paginatePerPage,
                page: PaginateCache::getPaginatePage() ?: static::$paginatePage
            );

            self::addPaginateSummary($_result);

            return $_result;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Add paginate summary information
     *
     * @param array|object $paginate
     * @return array
     */
    private static function addPaginateSummary(array|object $paginate): array
    {
        if (gettype($paginate) === 'object') {
            $_paginateData = $paginate->toArray();

            $_summary = [
                'paginate' => [
                    'current_data_from' => (string) $_paginateData['from'],
                    'current_data_to' => (string) $_paginateData['to'],
                    'current_page' => (string) $_paginateData['current_page'],
                    'first_page' => (string) '1',
                    'last_page' => (string) $_paginateData['last_page'],
                    'per_page' => (string) $_paginateData['per_page'],
                    'data_total' => (string) $_paginateData['total']
                ]
            ];
        } else {
            $_summary = $paginate;
        }

        PaginateCache::setPaginateSummaryInfo($_summary);

        return $_summary;
    }

    // ? Setter Modules
    /**
     * Set paginate data
     *
     * @param integer|null $perPage finance list paginate per page
     * @param integer|null $page finance list paginate pointer page
     * @return static
     */
    public static function setPaginate(?int $perPage = null, ?int $page = null): static
    {
        self::$paginatePerPage = $perPage ?: static::$paginatePerPage;

        self::$paginatePage = $page ?: static::$paginatePage;

        return new static;
    }
}
