<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function() {
    Route::prefix('/auth')->name('auth')->group(base_path('routes/api/v1/auth.php'));
    Route::prefix('/users')->name('users')->group(base_path('routes/api/v1/users.php'));
    Route::prefix('/tasks')->name('tasks')->group(base_path('routes/api/v1/tasks.php'));
    Route::prefix('/taskuser')->name('taskuser')->group(base_path('routes/api/v1/taskUser.php'));
    Route::prefix('/statisticuser')->name('statisticuser')->group(base_path('routes/api/v1/statisticUser.php'));
    Route::prefix('/categories')->name('categories')->group(base_path('routes/api/v1/categories.php'));
    Route::prefix('/relationship')->name('relationship')->group(base_path('routes/api/v1/relationship.php'));
});
