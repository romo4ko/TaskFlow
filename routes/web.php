<?php

declare(strict_types=1);

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Modules\Auth\Controllers\AuthController;

Route::group(['prefix' => 'api'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/checkAuth', [AuthController::class, 'getCurrentAuth'])->name('auth.currentAuth');

    // For authorized users
    Route::group(['middleware' => 'auth'], function () {
        Route::resource('projects', ProjectController::class);
        Route::get('/getProjectForm', [ProjectController::class, 'getFormData']);

        Route::resource('tasks', TaskController::class);
        Route::get('/getTaskForm', [TaskController::class, 'getFormData']);

        Route::resource('users', UserController::class);
        Route::get('/getUserForm', [UserController::class, 'getFormData']);

        Route::post('/tasks/comment', [CommentController::class, 'store']);
        Route::get('/comments', [CommentController::class, 'index']);
    });
});

Route::get('/{any}', fn() => view('spa'))
    ->where('any', '.*')
    ->name('spa');
