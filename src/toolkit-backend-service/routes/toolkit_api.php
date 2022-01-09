<?php

use Illuminate\Support\Facades\Route;
use TheBachtiarz\Toolkit\Backend\Controllers\API\AppController;

/**
 * route toolkit group
 * route :: base_url/thebachtiarz/toolkit/---
 */
Route::prefix('toolkit')->group(function () {
    /**
     * route config group
     * route :: base_url/thebachtiarz/toolkit/config/---
     */
    Route::prefix('config')->group(function () {

        /**
         * route for authorized only
         */
        Route::middleware('auth:sanctum')->group(function () {
            /**
             * route for get app name
             * route :: base_url/thebachtiarz/toolkit/config/app-name
             */
            Route::get('app-name', [AppController::class, 'getAppName']);

            /**
             * route for get app url
             * route :: base_url/thebachtiarz/toolkit/config/app-url
             */
            Route::get('app-url', [AppController::class, 'getAppUrl']);

            /**
             * route for get app timezone
             * route :: base_url/thebachtiarz/toolkit/config/app-timezone
             */
            Route::get('app-timezone', [AppController::class, 'getAppTimezone']);

            /**
             * route for get app prefix
             * route :: base_url/thebachtiarz/toolkit/config/app-prefix
             */
            Route::get('app-prefix', [AppController::class, 'getAppPrefix']);

            /**
             * route for set app name
             * route :: base_url/thebachtiarz/toolkit/config/app-name
             */
            Route::post('app-name', [AppController::class, 'setAppName']);

            /**
             * route for set app url
             * route :: base_url/thebachtiarz/toolkit/config/app-url
             */
            Route::post('app-url', [AppController::class, 'setAppUrl']);

            /**
             * route for set app timezone
             * route :: base_url/thebachtiarz/toolkit/config/app-timezone
             */
            Route::post('app-timezone', [AppController::class, 'setAppTimezone']);

            /**
             * route for set app prefix
             * route :: base_url/thebachtiarz/toolkit/config/app-prefix
             */
            Route::post('app-prefix', [AppController::class, 'setAppPrefix']);
        });
    });
});
