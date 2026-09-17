<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'courses' => Course::count(),
            'categories' => Category::count(),
            'levels' => Level::count(),
            'teachers' => Teacher::count(),
        ];

        $latestCourses = Course::with(['category', 'level', 'teacher'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latestCourses'));
    }
}
