<?php

namespace TheBachtiarz\Toolkit\Helper\App\Log;

use Illuminate\Support\Facades\Log;

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
     * @param string $level default: error
     * @return void
     * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md#5-psrlogloglevel
     */
    private static function logCatch(\Throwable $throwable, string $level = "error"): void
    {
        if (in_array(config('app.env'), tbtoolkitconfig('logger_mode'))) {
            $_logData = json_encode([
                'file' => $throwable->getFile(),
                'line' => $throwable->getLine(),
                'message' => $throwable->getMessage(),
                'code' => $throwable->getCode(),
            ]);

            Log::channel('error')->log($level, $_logData);
        }
    }
}
