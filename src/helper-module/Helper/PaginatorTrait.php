<?php

namespace TheBachtiarz\Toolkit\Helper\Helper;

/**
 * Paginator Trait
 */
trait PaginatorTrait
{
    //

    /**
     * Items request sorting
     *
     * @var array|null
     */
    private ?array $itemsRequestSort = null;

    // ? Public Methods

    // ? Private Modules
    /**
     * Init paginate
     *
     * @return self
     */
    public function initPaginate(): self
    {
        return $this;
    }

    /**
     * Get paginate result
     *
     * @param array $itemsResult
     * @param integer $pageSize
     * @param integer $currentPage
     * @return array
     */
    private function getPaginateResult(
        array $itemsResult = [],
        int $pageSize = 10,
        int $currentPage = 1
    ): array {
        $_result = [
            'items' => [],
            'page_info' => [
                'page_size' => $pageSize,
                'current_page' => $currentPage,
                'total_pages' => 1
            ],
            'total_count' => count($itemsResult)
        ];

        /**
         * Sorting process data result
         */
        if ($this->itemsRequestSort) {
            foreach ($this->itemsRequestSort as $attribute => $type) {
                $itemsResult = $this->sortArrayResult($itemsResult, $attribute, $type);
            }
        }

        $_dataResult = [];

        /**
         * Set total page
         */
        $_result['page_info']['total_pages'] = ceil($_result['total_count'] / $pageSize);

        /**
         * Define current page
         */
        for ($_loopCurrentPage = 1; $_loopCurrentPage <= $_result['page_info']['total_pages']; $_loopCurrentPage++) {
            /**
             * Check page section
             */
            if ($_loopCurrentPage === $currentPage) {
                /**
                 * Define start - finish item index
                 */
                $_indexStart = (($currentPage - 1) * $pageSize);
                $_indexFinish = $_result['total_count'] < ($currentPage * $pageSize)
                    ? $_result['total_count']
                    : ($currentPage * $pageSize);

                for ($_indexItem = $_indexStart; $_indexItem < $_indexFinish; $_indexItem++) {
                    if (($_indexItem + 1) > $_result['total_count']) break;
                    if (count($_dataResult) >= $pageSize) break;

                    $_dataResult[] = $itemsResult[$_indexItem];
                }
            }
        }

        $_result['items'] = $_dataResult;

        return $_result;
    }

    /**
     * Sort array result
     *
     * @param array $data
     * @param string $key
     * @param string $sortType
     * @return array
     */
    private function sortArrayResult(array $data, string $key = 'name', $sortType = 'ASC'): array
    {
        usort($data, function ($a, $b) use ($sortType, $key) {
            if ($sortType === 'ASC') return $a[$key] <=> $b[$key];
            if ($sortType === 'DESC') return $b[$key] <=> $a[$key];
        });

        return $data;
    }

    // ? Setter Modules
    /**
     * Add paginate sort
     *
     * @param string $attributeName
     * @param string $sortType
     * @return self
     */
    private function addPaginateSort(string $attributeName, string $sortType = 'ASC'): self
    {
        $this->itemsRequestSort[$attributeName] = $sortType;

        return $this;
    }
}
