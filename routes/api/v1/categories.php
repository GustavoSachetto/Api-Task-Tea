<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

// http://127.0.0.1:8000/api/v1/categories

Route::controller(CategoryController::class)->group(function() {
    Route::get('/', 'index')->name('.index');
    Route::get('/{id}', 'show')->name('.show');

    Route::middleware(['auth:sanctum', 'role:responsible'])->group(function() {
        Route::post('/', 'store')->name('.store');
        Route::put('/{id}', 'update')->name('.update');
        Route::delete('/{id}', 'destroy')->name('.destroy');
    });
});
