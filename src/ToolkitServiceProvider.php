<?php

namespace TheBachtiarz\Toolkit;

use Illuminate\Support\ServiceProvider;

class ToolkitServiceProvider extends ServiceProvider
{
    /**
     * Register module toolkit
     *
     * @return void
     */
    public function register(): void
    {
        $applicationToolkitService = new ApplicationToolkitService;

        $applicationToolkitService->registerConfig();

        if ($this->app->runningInConsole()) {
            $this->commands($applicationToolkitService->registerCommands());
        }
    }

    /**
     * Boot module toolkit
     *
     * @return void
     */
    public function boot(): void
    {
        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/' . ToolkitInterface::TOOLKIT_CONFIG_NAME . '.php' => config_path(ToolkitInterface::TOOLKIT_CONFIG_NAME . '.php'),
            ], 'thebachtiarz-toolkit-config');

            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'thebachtiarz-toolkit-migrations');
        }
    }
}
