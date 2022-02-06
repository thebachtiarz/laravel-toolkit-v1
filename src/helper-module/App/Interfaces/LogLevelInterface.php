<?php

namespace TheBachtiarz\Toolkit\Helper\App\Interfaces;

use Psr\Log\LogLevel;

interface LogLevelInterface
{
    /**
     * log level available
     */
    public const LOG_LEVEL_AVAILABLE = [
        LogLevel::EMERGENCY,
        LogLevel::ALERT,
        LogLevel::CRITICAL,
        LogLevel::ERROR,
        LogLevel::WARNING,
        LogLevel::NOTICE,
        LogLevel::INFO,
        LogLevel::DEBUG
    ];
}
