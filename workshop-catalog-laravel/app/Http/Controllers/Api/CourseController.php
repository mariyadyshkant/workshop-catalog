<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['category', 'level', 'teacher'])->get();
        return response()->json($courses);
    }
    public function show(Course $course)
    {
        $course->load(['category', 'level', 'teacher']);
        return response()->json($course);  
    }
}
