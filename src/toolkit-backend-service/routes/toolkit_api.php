<?php

use Illuminate\Support\Facades\Route;
use TheBachtiarz\Toolkit\Backend\Controllers\API\AppController;

/**
 * route for authentication
 * route :: base_url/toolkit/---
 */
Route::prefix('toolkit')->group(function () {

    /**
     * route for authentication
     * route :: base_url/toolkit/config/---
     */
    Route::prefix('config')->group(function () {

        Route::middleware('auth:sanctum')->group(function () {
            /**
             * route for authentication
             * route :: base_url/toolkit/config/app-name
             */
            Route::get('app-name', [AppController::class, 'getAppName']);

            /**
             * route for authentication
             * route :: base_url/toolkit/config/app-url
             */
            Route::get('app-url', [AppController::class, 'getAppUrl']);

            /**
             * route for authentication
             * route :: base_url/toolkit/config/app-timezone
             */
            Route::get('app-timezone', [AppController::class, 'getAppTimezone']);

            /**
             * route for authentication
             * route :: base_url/toolkit/config/app-name
             */
            Route::post('app-name', [AppController::class, 'setAppName']);

            /**
             * route for authentication
             * route :: base_url/toolkit/config/app-url
             */
            Route::post('app-url', [AppController::class, 'setAppUrl']);

            /**
             * route for authentication
             * route :: base_url/toolkit/config/app-timezone
             */
            Route::post('app-timezone', [AppController::class, 'setAppTimezone']);
        });
    });
});
