<?php

namespace TheBachtiarz\Toolkit\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\{Artisan, Log};
use Symfony\Component\Process\Process;
use TheBachtiarz\Toolkit\Console\Service\KeepCacheService;
use TheBachtiarz\Toolkit\Console\Service\ScheduleCacheProcessService;

class AppRefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thebachtiarz:toolkit:app:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Toolkit: Refresh the app for clean all cache etc.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Composer $composer)
    {
        parent::__construct();
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $result = 0;

        try {
            Log::channel('maintenance')->info('----> Maintenance server daily, started...');
            $this->info('======> Execute app refresh maintenance');

            (new Process(explode(' ', 'php artisan down')))->run();

            Log::channel('maintenance')->info('~~ Application is now in maintenance mode.');
            $this->info('======> Activate maintenance mode');

            /**
             * Keep cache(s) process
             */
            KeepCacheService::setKeepCacheName(tbtoolkitconfig('app_keep_cache_data'))->backupCache();
            $this->info('======> Keeping cache if exist');

            /**
             * Run artisan command before
             */
            $this->runCommands(tbtoolkitconfig('app_refresh_artisan_commands_before'));
            $this->info('======> Running command config commands before');

            $this->info('======> Caching process start');
            /**
             * Any module who need caching is execute here
             */
            if (count(tbtoolkitconfig('app_refresh_cache_classes')))
                ScheduleCacheProcessService::runSchedule();

            $this->info('======> Caching process finish');

            $this->composer->dumpAutoloads();

            Log::channel('maintenance')->info('+ Composer successfully regenerate autoload.');
            $this->info('======> Composer dump-autoload');

            /**
             * Run artisan command after
             */
            $this->runCommands(tbtoolkitconfig('app_refresh_artisan_commands_after'));
            $this->info('======> Running command config commands after');

            /**
             * Restore keep cache(s) into database
             */
            KeepCacheService::restoreCache();
            $this->info('======> Restoring keeping cache if exist');

            (new Process(explode(' ', 'php artisan up')))->run();

            Log::channel('maintenance')->info('~~ Application is now live.');
            $this->info('======> Disable maintenance mode');

            Log::channel('maintenance')->info('----> Maintenance server daily, success');
            $this->info('======> Finish app refresh maintenance');

            $result = 1;
        } catch (\Throwable $th) {
            Log::channel('maintenance')->warning("----> Maintenance server daily, failed : {$th->getMessage()}, Line: {$th->getLine()}");
        } finally {
            Log::channel('maintenance')->info('');

            return $result;
        }
    }

    /**
     * Run commands from config
     *
     * @param array $commands
     * @return void
     */
    private function runCommands(array $commands = []): void
    {
        foreach ($commands as $key => $command) {
            Artisan::call($command['command']);

            Log::channel('maintenance')->info($command['message']);
        }
    }
}
