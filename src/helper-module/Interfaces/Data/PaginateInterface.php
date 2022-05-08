<?php

namespace TheBachtiarz\Toolkit\Helper\Interfaces\Data;

interface PaginateInterface
{
    /**
     * paginate condition name
     */
    public const PAGINATE_CONDITION_NAME = '__paginateCondition';

    /**
     * paginate params page name
     */
    public const PAGINATE_PARAMS_PAGE_NAME = '__paginatePage';

    /**
     * paginate params page per page
     */
    public const PAGINATE_PARAMS_PERPAGE_NAME = '__paginatePerPage';

    /**
     * paginate summary info
     */
    public const PAGINATE_SUMMARY_INFO_NAME = '__paginateSummaryInfo';

    /**
     * paginate config result default init page
     */
    public const PAGINATE_CONFIG_RESULT_DEFAULT_INIT_PAGE = 1;

    /**
     * paginate config result default init per page
     */
    public const PAGINATE_CONFIG_RESULT_DEFAULT_INIT_PERPAGE = 10;
}
