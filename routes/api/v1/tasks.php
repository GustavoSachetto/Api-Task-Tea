<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// http://127.0.0.1:8000/api/v1/tasks

Route::controller(TaskController::class)->group(function () {
    Route::get('/', 'index')->name('.index');
    Route::get('/by/{id}', 'show')->name('.show');
    Route::get('/category/{id}', 'search')->name('.search');

    Route::middleware(['auth:sanctum', 'role:responsible'])->group(function () {
        Route::get('/mytasks', 'myTasks')->name('.myTasks');
        Route::get('/templates', 'templates')->name('.templates');
        Route::get('/search/{value}', 'searchTitleOrContent')->name('.searchTitleOrContent');
        Route::post('/', 'store')->name('.store');
        Route::post('/image/{id}', 'storeImage')->name('.storeImage');
        Route::put('/{id}', 'update')->name('.update');
        Route::delete('/{id}', 'destroy')->name('.destroy');
    });
});
