<?php

use Illuminate\Support\Facades\Route;

Route::prefix('toolkit')->group(function () {
    //
    Route::prefix('config')->group(function () {
        //
        // Route::middleware('auth:sanctum')->group(function () {
        //
        Route::get('app-name', [\TheBachtiarz\Toolkit\Backend\Controllers\API\AppController::class, 'getAppName']);
        // });
    });
});
