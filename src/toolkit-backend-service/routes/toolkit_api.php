<?php

use Illuminate\Support\Facades\Route;
use TheBachtiarz\Toolkit\Backend\Controllers\API\AppController;

/**
 * Route toolkit group
 * Route :: base_url/{{app_prefix}}/toolkit/---
 */
Route::prefix('toolkit')->group(function () {

    /**
     * Route config group
     * Route :: base_url/{{app_prefix}}/toolkit/config/---
     */
    Route::prefix('config')->group(function () {

        /**
         * Route for authorized only
         */
        Route::middleware('auth:sanctum')->controller(AppController::class)->group(function () {

            /**
             * Route for get app name
             * Method :: GET
             * Route :: base_url/{{app_prefix}}/toolkit/config/app-name
             */
            Route::get('app-name', 'getAppName');

            /**
             * Route for get app url
             * Method :: GET
             * Route :: base_url/{{app_prefix}}/toolkit/config/app-url
             */
            Route::get('app-url', 'getAppUrl');

            /**
             * Route for get app timezone
             * Method :: GET
             * Route :: base_url/{{app_prefix}}/toolkit/config/app-timezone
             */
            Route::get('app-timezone', 'getAppTimezone');

            /**
             * Route for get app prefix
             * Method :: GET
             * Route :: base_url/{{app_prefix}}/toolkit/config/app-prefix
             */
            Route::get('app-prefix', 'getAppPrefix');

            /**
             * Route for set app name
             * Method :: POST
             * Route :: base_url/{{app_prefix}}/toolkit/config/app-name
             */
            Route::post('app-name', 'setAppName');

            /**
             * Route for set app url
             * Method :: POST
             * Route :: base_url/{{app_prefix}}/toolkit/config/app-url
             */
            Route::post('app-url', 'setAppUrl');

            /**
             * Route for set app timezone
             * Method :: POST
             * Route :: base_url/{{app_prefix}}/toolkit/config/app-timezone
             */
            Route::post('app-timezone', 'setAppTimezone');

            /**
             * Route for set app prefix
             * Method :: POST
             * Route :: base_url/{{app_prefix}}/toolkit/config/app-prefix
             */
            Route::post('app-prefix', 'setAppPrefix');
        });
    });
});
