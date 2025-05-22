<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Course;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['course', 'classroom'])->latest()->paginate(10);
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $courses = Course::all();
        $classrooms = Classroom::all();
        return view('admin.schedules.create', compact('courses', 'classrooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'day_of_week' => 'required|in:Lundi,Mardi,Mercredi,Jeudi,Vendredi,Samedi',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'semester' => 'required|in:1,2',
        ]);

        Schedule::create($validated);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Emploi du temps créé avec succès.');
    }

    public function show(Schedule $schedule)
    {
        return view('admin.schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        $courses = Course::all();
        $classrooms = Classroom::all();
        return view('admin.schedules.edit', compact('schedule', 'courses', 'classrooms'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'day_of_week' => 'required|in:Lundi,Mardi,Mercredi,Jeudi,Vendredi,Samedi',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'semester' => 'required|in:1,2',
        ]);

        $schedule->update($validated);

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Emploi du temps mis à jour avec succès.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('admin.schedules.index')
            ->with('success', 'Emploi du temps supprimé avec succès.');
    }
} 