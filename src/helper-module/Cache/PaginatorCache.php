<?php

namespace TheBachtiarz\Toolkit\Helper\Cache;

class PaginatorCache
{
    //

    /**
     * Paginator service status
     *
     * @var boolean
     */
    protected static bool $enable = false;

    /**
     * Current page
     *
     * @var integer
     */
    protected static int $currentPage = 1;

    /**
     * Result per page
     *
     * @var integer
     */
    protected static int $perPage = 10;

    // ? Public Methods
    /**
     * Enable/Disable paginator service
     *
     * @param boolean $status
     * @return static
     */
    public static function enable(bool $status = true): static
    {
        static::$enable = $status;

        return new static;
    }

    /**
     * Reset paginator
     *
     * @return static
     */
    public static function reset(): static
    {
        return static::setCurrentPage(static::$currentPage)->setPerPage(static::$perPage);
    }

    // ? Getter Modules
    /**
     * Is paginator enable
     *
     * @return boolean
     */
    public static function isEnable(): bool
    {
        return static::$enable;
    }

    /**
     * Get current page
     *
     * @return integer default: 1
     */
    public static function getCurrentPage(): int
    {
        return static::$currentPage;
    }

    /**
     * Get result per page
     *
     * @return integer default: 10
     */
    public static function getPerPage(): int
    {
        return static::$perPage;
    }

    // ? Setter Modules
    /**
     * Set current page
     *
     * @param integer|null $currentPage
     * @return static
     */
    public static function setCurrentPage(?int $currentPage = null): static
    {
        if ($currentPage) {
            static::$currentPage = $currentPage;
        }

        return new static;
    }

    /**
     * Set result per page
     *
     * @param integer|null $perPage
     * @return static
     */
    public static function setPerPage(?int $perPage = null): static
    {
        if ($perPage) {
            static::$perPage = $perPage;
        }

        return new static;
    }
}
