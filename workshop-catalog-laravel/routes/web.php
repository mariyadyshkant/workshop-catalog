<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // Gli admin hanno una vera home del backoffice; un utente normale
    // vede ancora la pagina Breeze di base.
    if (auth()->user()->is_admin) {
        return app(DashboardController::class)->index();
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->group(function () {
        Route::resource('courses', CourseController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('levels', LevelController::class);
        Route::resource('teachers', TeacherController::class);
    });
});

require __DIR__ . '/auth.php';
