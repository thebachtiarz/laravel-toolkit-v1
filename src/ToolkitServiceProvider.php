<?php

namespace TheBachtiarz\Toolkit;

use Illuminate\Support\ServiceProvider;

class ToolkitServiceProvider extends ServiceProvider
{
    private const COMMANDS = [
        \TheBachtiarz\Toolkit\Console\Commands\AppRefresh::class
    ];

    //
    /**
     * register module toolkit
     *
     * @return void
     */
    public function register(): void
    {
        config(['cache.default' => 'database']);

        if ($this->app->runningInConsole()) {
            $this->commands(self::COMMANDS);
        }
    }

    /**
     * boot module toolkit
     *
     * @return void
     */
    public function boot(): void
    {
        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'toolkit-migrations');

            $this->publishes([
                __DIR__ . '/../config/thebachtiarz_toolkit.php' => config_path('thebachtiarz_toolkit.php'),
            ], 'toolkit-config');
        }
    }
}
