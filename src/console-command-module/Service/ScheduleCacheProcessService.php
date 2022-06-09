<?php

namespace TheBachtiarz\Toolkit\Console\Service;

use Illuminate\Support\Facades\Log;
use TheBachtiarz\Toolkit\Config\Interfaces\Classes\ScheduleCacheInterface;
use TheBachtiarz\Toolkit\Helper\App\Log\ErrorLogTrait;

class ScheduleCacheProcessService
{
    use ErrorLogTrait;

    /**
     * Run cache process on config schedule
     *
     * @return boolean
     */
    public static function runSchedule(): bool
    {
        try {
            $_classes = tbtoolkitconfig('app_refresh_cache_classes');

            foreach ($_classes as $key => $class) {
                if (new $class instanceof ScheduleCacheInterface)
                    $class::process();
                else
                    Log::channel('error')->info("Class {$class} is not implement ScheduleCacheInterface interface");
            }

            return true;
        } catch (\Throwable $th) {
            self::logCatch($th);

            return false;
        }
    }
}
