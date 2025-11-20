<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRelationshipController;

// http://127.0.0.1:8000/api/v1/relationship

Route::controller(UserRelationshipController::class)->group(function() {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/', 'createToken')->name('.createToken')->middleware('role:child');

        Route::middleware('role:child')->group(function() {
            Route::delete('/', 'myDestroy')->name('.myDestroy');
        });

        Route::middleware('role:responsible')->group(function() {
            Route::post('/', 'storeRelationship')->name('.storeRelationship');
            Route::delete('/{id}', 'destroy')->name('.destroy');
        });
    });
});
