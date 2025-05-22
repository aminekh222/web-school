<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $courses = Course::withCount('notes')->get();
        return view('admin.notes.index', compact('courses'));
    }

    public function showCourseNotes(Course $course)
    {
        $notes = Note::where('course_id', $course->id)->with('user')->get();
        return view('admin.notes.course', compact('course', 'notes'));
    }

    public function create()
    {
        $students = User::where('role', 'student')->get();
        $courses = Course::all();
        return view('admin.notes.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'value' => 'required|numeric|min:0|max:20',
            'type' => 'required|in:exam,tp,project',
            'semester' => 'required|in:1,2',
            'comment' => 'nullable|string|max:255',
        ]);
        Note::create($request->all());
        return redirect()->route('admin.notes.index')->with('success', 'Note ajoutée avec succès.');
    }

    public function edit(Note $note)
    {
        $students = User::where('role', 'student')->get();
        $courses = Course::all();
        return view('admin.notes.edit', compact('note', 'students', 'courses'));
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'value' => 'required|numeric|min:0|max:20',
            'type' => 'required|in:exam,tp,project',
            'semester' => 'required|in:1,2',
            'comment' => 'nullable|string|max:255',
        ]);
        $note->update($request->all());
        return redirect()->route('admin.notes.index')->with('success', 'Note modifiée avec succès.');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('admin.notes.index')->with('success', 'Note supprimée avec succès.');
    }
} 