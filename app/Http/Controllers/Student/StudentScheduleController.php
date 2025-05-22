<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class StudentScheduleController extends Controller
{
    public function index()
    {
        // Récupérer l'étudiant connecté
        $student = auth()->user();
        
        // Récupérer les cours de l'étudiant
        $courses = $student->courses;
        
        // Récupérer les emplois du temps pour ces cours
        $schedules = Schedule::whereIn('course_id', $courses->pluck('id'))
            ->with(['course', 'classroom'])
            ->orderBy('day_of_week')
            ->orderBy('start_time')
            ->get()
            ->groupBy('day_of_week');

        return view('student.schedule.index', compact('schedules'));
    }
} 