<?php

namespace TheBachtiarz\Toolkit;

use Illuminate\Support\ServiceProvider;

class ToolkitServiceProvider extends ServiceProvider
{
    /**
     * register module toolkit
     *
     * @return void
     */
    public function register(): void
    {
        //
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
