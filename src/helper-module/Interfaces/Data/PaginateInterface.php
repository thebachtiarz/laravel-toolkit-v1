<?php

namespace TheBachtiarz\Toolkit\Helper\Interfaces\Data;

interface PaginateInterface
{
    /**
     * paginate params page name
     */
    public const PAGINATE_PARAMS_PAGE_NAME = '__paginatePage';

    /**
     * paginate params page per page
     */
    public const PAGINATE_PARAMS_PERPAGE_NAME = '__paginatePerPage';

    /**
     * paginate config result default init page
     */
    public const PAGINATE_CONFIG_RESULT_DEFAULT_INIT_PAGE = 1;

    /**
     * paginate config result default init per page
     */
    public const PAGINATE_CONFIG_RESULT_DEFAULT_INIT_PERPAGE = 10;
}
