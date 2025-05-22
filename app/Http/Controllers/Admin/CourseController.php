<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'semester' => ['required', 'string', 'in:1,2'],
        ]);

        Course::create($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Cours créé avec succès.');
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'semester' => ['required', 'string', 'in:1,2'],
        ]);

        $course->update($validated);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Cours mis à jour avec succès.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Cours supprimé avec succès.');
    }
} 