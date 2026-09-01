<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseRequest;
use App\Models\Course;
use App\Models\Category;
use App\Models\Level;
use App\Models\Teacher;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with(['category', 'level', 'teacher'])->get();
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $levels = Level::all();
        $teachers = Teacher::all();

        return view('admin.courses.create', compact('categories', 'levels', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        $validateData = $request->validated();

        if ($request->hasFile('image')) {
            $validateData['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($validateData);
        return redirect()->route('courses.index')->with('success', 'Corso creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        $levels = Level::all();
        $teachers = Teacher::all();

        return view('admin.courses.edit', compact('course', 'categories', 'levels', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course)
    {
        $validateData = $request->validated();

        if ($request->hasFile('image')) {
            $validateData['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($validateData);
        return redirect()->route('courses.index')->with('success', 'Corso aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Corso eliminato con successo!');
    }
}
