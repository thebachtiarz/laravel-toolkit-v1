<?php

namespace TheBachtiarz\Toolkit\Console\Service;

use Illuminate\Support\Facades\Log;
use TheBachtiarz\Toolkit\Config\Interfaces\Class\ScheduleCacheInterface;

class ScheduleCacheProcessService
{
    /**
     * run cache process on config schedule
     *
     * @return boolean
     */
    public static function runSchedule(): bool
    {
        try {
            $_classes = tbtoolkitconfig('app_refresh_cache_classes');

            foreach ($_classes as $key => $class)
                if ($class instanceof ScheduleCacheInterface)
                    $class::process();

            return true;
        } catch (\Throwable $th) {
            Log::channel('error')->warning($th->getMessage());

            return false;
        }
    }
}
