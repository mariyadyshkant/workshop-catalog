<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\LevelResource;
use App\Models\Category;
use App\Models\Level;

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{course}', [CourseController::class, 'show']);
Route::get('/categories', fn() => CategoryResource::collection(Category::orderBy('name')->get()));
Route::get('/levels', fn() => LevelResource::collection(Level::orderBy('name')->get()));