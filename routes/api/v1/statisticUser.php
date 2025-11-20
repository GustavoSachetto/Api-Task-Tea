<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatisticUserController;

// http://127.0.0.1:8000/api/v1/statisticuser

Route::controller(StatisticUserController::class)->group(function () {

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::middleware(['role:child'])->group(function () {
            Route::get('/mytotal', 'myTotal')->name('.myTotal');
            Route::get('/myweekly', 'myWeekly')->name('.myWeekly');
        });

        Route::middleware(['role:responsible'])->group(function () {
            Route::get('/total/{id}', 'fetchTotal')->name('.fetchTotal');
            Route::get('/weekly/{id}', 'fetchWeekly')->name('.fetchWeekly');
        });
    });
});

