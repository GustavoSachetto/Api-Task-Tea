<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// http://127.0.0.1:8000/api/v1/auth

Route::controller(AuthController::class)->group(function() {
    Route::post('/login', 'login')->name('.login');
    Route::post('/logout', 'logout')->name('.logout')->middleware('auth:sanctum');
});