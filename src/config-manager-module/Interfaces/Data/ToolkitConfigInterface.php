<?php

namespace TheBachtiarz\Toolkit\Config\Interfaces\Data;

interface ToolkitConfigInterface
{
    public const TOOLKIT_CONFIG_USER_GROUP_DATA = [
        SELF::TOOLKIT_CONFIG_USER_CODE => SELF::TOOLKIT_CONFIG_USER_NAME,
        SELF::TOOLKIT_CONFIG_ADMIN_CODE => SELF::TOOLKIT_CONFIG_ADMIN_NAME,
    ];

    public const TOOLKIT_CONFIG_USER_CODE = "1";
    public const TOOLKIT_CONFIG_ADMIN_CODE = "2";
    public const TOOLKIT_CONFIG_USER_NAME = "Public";
    public const TOOLKIT_CONFIG_ADMIN_NAME = "Private";
}
