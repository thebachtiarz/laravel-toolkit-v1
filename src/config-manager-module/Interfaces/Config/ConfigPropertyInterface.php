<?php

namespace TheBachtiarz\Toolkit\Config\Interfaces\Config;

interface ConfigPropertyInterface
{
    /**
     * Tag code config for value
     */
    public const PROPERTY_CONFIG_TAG_WITHOUT_QUOTE_CODE = '';
    public const PROPERTY_CONFIG_TAG_SINGLE_QUOTE_CODE = "'";
    public const PROPERTY_CONFIG_TAG_DOUBLE_QUOTE_CODE = '"';

    /**
     * Tag available config for value
     */
    public const PROPERTY_CONFIG_TAG_WITHOUT_QUOTE_AVAILABLE = ["boolean", "bool"];
    public const PROPERTY_CONFIG_TAG_SINGLE_QUOTE_AVAILABLE = ["char"];
    public const PROPERTY_CONFIG_TAG_DOUBLE_QUOTE_AVAILABLE = ["string", "varchar"];
}
