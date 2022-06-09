<?php

namespace TheBachtiarz\Toolkit\Helper\Interfaces\Data;

interface PaginateInterface
{
    /**
     * Paginate condition name
     */
    public const PAGINATE_CONDITION_NAME = '__paginateCondition';

    /**
     * Paginate params page name
     */
    public const PAGINATE_PARAMS_PAGE_NAME = '__paginatePage';

    /**
     * Paginate params page per page
     */
    public const PAGINATE_PARAMS_PERPAGE_NAME = '__paginatePerPage';

    /**
     * Paginate summary info
     */
    public const PAGINATE_SUMMARY_INFO_NAME = '__paginateSummaryInfo';

    /**
     * Paginate config result default init page
     */
    public const PAGINATE_CONFIG_RESULT_DEFAULT_INIT_PAGE = 1;

    /**
     * Paginate config result default init per page
     */
    public const PAGINATE_CONFIG_RESULT_DEFAULT_INIT_PERPAGE = 10;
}
