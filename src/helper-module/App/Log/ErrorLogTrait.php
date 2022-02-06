<?php

namespace TheBachtiarz\Toolkit\Helper\App\Log;

use Illuminate\Support\Facades\Log;
use Psr\Log\LogLevel;
use TheBachtiarz\Toolkit\Helper\App\Interfaces\LogLevelInterface;

/**
 * Error Log Trait
 */
trait ErrorLogTrait
{
    /**
     * log error from throwable object value.
     * only execute not in production mode.
     *
     * @param \Throwable $throwable
     * @param string $logLevel
     * @return void
     * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md#5-psrlogloglevel
     */
    private static function logCatch(\Throwable $throwable, string $logLevel = ""): void
    {
        if (in_array(config('app.env'), tbtoolkitconfig('logger_mode'))) {
            $logLevel = in_array($logLevel, LogLevelInterface::LOG_LEVEL_AVAILABLE) ? $logLevel : LogLevel::ERROR;

            $_logData = json_encode([
                'file' => $throwable->getFile(),
                'line' => $throwable->getLine(),
                'message' => $throwable->getMessage(),
                'code' => $throwable->getCode(),
            ]);

            Log::channel('error')->log($logLevel, $_logData);
        }
    }
}
