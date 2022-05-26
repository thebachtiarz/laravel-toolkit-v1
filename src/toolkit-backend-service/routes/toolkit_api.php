<?php

use Illuminate\Support\Facades\Route;
use TheBachtiarz\Toolkit\Backend\Controllers\API\AppController;

/**
 * route toolkit group
 * route :: base_url/{{app_prefix}}/toolkit/---
 */
Route::prefix('toolkit')->group(function () {

    /**
     * route config group
     * route :: base_url/{{app_prefix}}/toolkit/config/---
     */
    Route::prefix('config')->group(function () {

        /**
         * route for authorized only
         */
        Route::middleware('auth:sanctum')->controller(AppController::class)->group(function () {

            /**
             * route for get app name
             * method :: GET
             * route :: base_url/{{app_prefix}}/toolkit/config/app-name
             */
            Route::get('app-name', 'getAppName');

            /**
             * route for get app url
             * method :: GET
             * route :: base_url/{{app_prefix}}/toolkit/config/app-url
             */
            Route::get('app-url', 'getAppUrl');

            /**
             * route for get app timezone
             * method :: GET
             * route :: base_url/{{app_prefix}}/toolkit/config/app-timezone
             */
            Route::get('app-timezone', 'getAppTimezone');

            /**
             * route for get app prefix
             * method :: GET
             * route :: base_url/{{app_prefix}}/toolkit/config/app-prefix
             */
            Route::get('app-prefix', 'getAppPrefix');

            /**
             * route for set app name
             * method :: POST
             * route :: base_url/{{app_prefix}}/toolkit/config/app-name
             */
            Route::post('app-name', 'setAppName');

            /**
             * route for set app url
             * method :: POST
             * route :: base_url/{{app_prefix}}/toolkit/config/app-url
             */
            Route::post('app-url', 'setAppUrl');

            /**
             * route for set app timezone
             * method :: POST
             * route :: base_url/{{app_prefix}}/toolkit/config/app-timezone
             */
            Route::post('app-timezone', 'setAppTimezone');

            /**
             * route for set app prefix
             * method :: POST
             * route :: base_url/{{app_prefix}}/toolkit/config/app-prefix
             */
            Route::post('app-prefix', 'setAppPrefix');
        });
    });
});
