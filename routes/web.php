<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Students
    // STUDENT ROUTES
    Route::get('/student', [StudentController::class, 'index'])
        ->name('students.index');

    Route::get('/student/{id}', [StudentController::class, 'show'])
        ->name('students.show');

    Route::get('/student/{id}/edit', [StudentController::class, 'edit'])
        ->name('students.edit');

    Route::delete('/student/{id}', [StudentController::class, 'destroy'])
        ->name('students.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';
