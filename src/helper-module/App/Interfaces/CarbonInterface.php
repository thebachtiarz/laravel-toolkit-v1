<?php

namespace TheBachtiarz\Toolkit\Helper\App\Interfaces;

interface CarbonInterface
{
    public const CARBON_FULL_HUMAN_DATE_FORMAT = "dddd, D MMMM YYYY, HH:mm:ss";
    public const CARBON_HUMAN_SIMPLE_DATE_FORMAT = "d F Y H:i:s";
    public const CARBON_HUMAN_DATE_FORMAT = "d F Y";
    public const CARBON_HUMAN_TIME_FORMAT = "H:i:s";
    public const CARBON_DB_SIMPLE_DATE_FORMAT = "Y-m-d H:i:s";
    public const CARBON_DB_DATE_FORMAT = "Y-m-d";
    public const CARBON_DB_TIME_FORMAT = "H:i:s";
}
