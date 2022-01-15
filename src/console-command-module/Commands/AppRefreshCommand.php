<?php

namespace TheBachtiarz\Toolkit\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\{Artisan, Log};
use Symfony\Component\Process\Process;
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
    public function handle()
    {
        try {
            Log::channel('maintenance')->info('----> Maintenance server daily, started...');

            (new Process(explode(' ', 'php artisan down')))->run();

            Log::channel('maintenance')->info('~~ Application is now in maintenance mode.');

            foreach (tbtoolkitconfig('app_refresh_artisan_commands_before') as $key => $command) {
                Artisan::call($command['command']);

                Log::channel('maintenance')->info($command['message']);
            }

            // any module who need caching is execute here...
            if (count(tbtoolkitconfig('app_refresh_cache_classes')))
                ScheduleCacheProcessService::runSchedule();

            $this->composer->dumpAutoloads();

            Log::channel('maintenance')->info('+ Composer successfully regenerate autoload.');

            foreach (tbtoolkitconfig('app_refresh_artisan_commands_after') as $key => $command) {
                Artisan::call($command['command']);

                Log::channel('maintenance')->info($command['message']);
            }

            (new Process(explode(' ', 'php artisan up')))->run();

            Log::channel('maintenance')->info('~~ Application is now live.');

            Log::channel('maintenance')->info('----> Maintenance server daily, success');
        } catch (\Throwable $th) {
            Log::channel('maintenance')->warning('----> Maintenance server daily, failed : ' . $th->getMessage() . $th->getLine());
        } finally {
            Log::channel('maintenance')->info('');
        }
    }
}
