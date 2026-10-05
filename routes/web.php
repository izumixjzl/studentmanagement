<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::delete('/students/bulk', [StudentController::class, 'bulkDestroy'])
        ->name('students.bulk-destroy');

    Route::resource('students', StudentController::class);

    Route::delete('/courses/bulk', [CourseController::class, 'bulkDestroy'])
        ->name('courses.bulk-destroy');

    Route::resource('courses', CourseController::class);

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});