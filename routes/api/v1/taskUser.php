<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskUserController;

// http://127.0.0.1:8000/taskuser

Route::controller(TaskUserController::class)->group(function () {

    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('/', 'index')->name('.index');
        Route::get('/by/{id}', 'show')->name('.show');
        Route::get('/search/{value}', 'search')->name('.search');
        Route::get('/finished/{done}', 'finished')->name('.finished');

        Route::middleware('role:responsible')->group(function() {
            Route::post('/', 'store')->name('.store');
            Route::delete('/{id}', 'destroy')->name('.destroy');
        });

        Route::middleware('role:child')->group(function() {
            Route::get('/taskday', 'taskDay')->name('.taskDay');
            Route::put('/{id}', 'update')->name('.update');
        });
    });
});

