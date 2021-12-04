<?php

namespace TheBachtiarz\Toolkit\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class AppRefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'toolkit:app:refresh';

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

            foreach (config('thebachtiarz_toolkit.app_refresh_artisan_commands') as $key => $command) {
                Artisan::call($command['command']);
                Log::channel('maintenance')->info($command['message']);
            }

            // any module who need caching is execute here...
            if (count(config('thebachtiarz_toolkit.app_refresh_cache_classes')))
                foreach (config('thebachtiarz_toolkit.app_refresh_cache_classes') as $key => $class)
                    $class::process();

            $this->composer->dumpAutoloads();
            Log::channel('maintenance')->info('+ Composer successfully regenerate autoload.');

            (new Process(explode(' ', 'php artisan up')))->run();
            Log::channel('maintenance')->info('~~ Application is now live.');

            Log::channel('maintenance')->info('----> Maintenance server daily, success');
        } catch (\Throwable $th) {
            Log::channel('maintenance')->info('----> Maintenance server daily, failed : ' . $th->getMessage());
        } finally {
            Log::channel('maintenance')->info('');
        }
    }
}
