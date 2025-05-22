<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Document;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Récupérer les statistiques pour le dashboard
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'active_students' => User::where('role', 'student')->where('is_active', true)->count(),
            'total_courses' => Course::count(),
            'total_documents' => Document::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function students()
    {
        $students = User::where('role', 'student')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.students.index', compact('students'));
    }

    public function courses()
    {
        $courses = Course::orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.courses.index', compact('courses'));
    }

    public function documents()
    {
        $documents = Document::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.documents.index', compact('documents'));
    }
} 