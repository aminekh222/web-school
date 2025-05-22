<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Document;
use App\Models\Note;
use App\Models\User;
use App\Models\Announcement;
use App\Models\Attestation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Optimisation des statistiques avec une seule requête
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'active_students' => User::where('role', 'student')
                ->whereNotNull('email_verified_at')
                ->count(),
            'total_courses' => Course::count(),
            'total_documents' => Document::count(),
            'total_notes' => Note::count(),
            'average_note' => Note::avg('value') ?? 0,
            'total_attestations' => Attestation::count(),
            'attestations_en_attente' => Attestation::where('statut', 'en_attente')->count(),
        ];

        // Optimisation des requêtes avec eager loading et sélection des colonnes nécessaires
        $latestNotes = Note::with([
                'user:id,name',
                'course:id,name,semester'
            ])
            ->select('id', 'user_id', 'course_id', 'value', 'created_at')
            ->latest()
            ->take(10)
            ->get();

        $latestAnnouncements = Announcement::with(['user:id,name'])
            ->select('id', 'user_id', 'title', 'content', 'is_important', 'created_at')
            ->orderBy('is_important', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $latestAttestations = Attestation::with(['student:id,name'])
            ->select('id', 'student_id', 'numero_attestation', 'type_attestation', 'created_at')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latestNotes', 'latestAnnouncements', 'latestAttestations'));
    }
} 