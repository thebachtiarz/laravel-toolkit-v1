<?php

namespace TheBachtiarz\Toolkit\Config\Interfaces\Data;

interface ToolkitConfigInterface
{
    public const TOOLKIT_CONFIG_PREFIX_NAME = "toolkit";

    public const TOOLKIT_CONFIG_USER_GROUP_DATA = [
        SELF::TOOLKIT_CONFIG_PUBLIC_CODE => SELF::TOOLKIT_CONFIG_PUBLIC_NAME,
        SELF::TOOLKIT_CONFIG_PRIVATE_CODE => SELF::TOOLKIT_CONFIG_PRIVATE_NAME,
    ];

    public const TOOLKIT_CONFIG_PUBLIC_CODE = "1";
    public const TOOLKIT_CONFIG_PRIVATE_CODE = "2";
    public const TOOLKIT_CONFIG_PUBLIC_NAME = "Public";
    public const TOOLKIT_CONFIG_PRIVATE_NAME = "Private";

    public const TOOLKIT_CONFIG_APP_NAME_NAME = "app_name";
    public const TOOLKIT_CONFIG_APP_URL_NAME = "app_url";
    public const TOOLKIT_CONFIG_APP_TIMEZONE_NAME = "app_timezone";
    public const TOOLKIT_CONFIG_APP_PREFIX_NAME = "app_prefix";
    public const TOOLKIT_CONFIG_APP_KEY_NAME = "app_key";
}
