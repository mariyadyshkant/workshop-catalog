<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;
use App\Models\Category;
use App\Models\Level;

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{course}', [CourseController::class, 'show']);
Route::get('/categories', fn() => response()->json(Category::orderBy('name')->get()));
Route::get('/levels', fn() => response()->json(Level::orderBy('name')->get()));