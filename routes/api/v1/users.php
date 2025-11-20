<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// http://127.0.0.1:8000/api/v1/users

Route::controller(UserController::class)->group(function() {
    Route::post('/child', 'storeChild')->name('.storeChild');
    Route::post('/responsible', 'storeResponsible')->name('.storeResponsible');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/', 'index')->name('.index');
        Route::get('/relationship', 'myRelationship')->name('.myrelationship');
        Route::put('/', 'update')->name('.update');
        Route::delete('/', 'destroy')->name('.destroy');
        Route::post('/image', 'storeImage')->name('.storeImage');
        Route::post('/banner', 'storeBanner')->name('.storeBanner');
    });
});
