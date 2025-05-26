<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Note;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class StudentController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        
        // Optimisation des requêtes avec eager loading
        $documents = $user->documents()
            ->latest()
            ->take(5)
            ->get();
        
        $notes = $user->notes()
            ->with(['course' => function($query) {
                $query->select('id', 'name', 'semester');
            }])
            ->latest()
            ->take(5)
            ->get();
        
        $latestAnnouncements = Announcement::with(['user' => function($query) {
                $query->select('id', 'name');
            }])
            ->where(function($query) {
                $query->whereNull('expiry_date')
                      ->orWhere('expiry_date', '>', now());
            })
            ->orderBy('is_important', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        
        return view('student.dashboard', compact('documents', 'notes', 'latestAnnouncements'));
    }

    public function profile()
    {
        $user = auth()->user();
        
        // Mise en cache des données du profil pour 1 heure
        $user = Cache::remember('user_profile_' . auth()->id(), 3600, function () {
            return auth()->user()->load(['documents' => function($query) {
                $query->select('id', 'user_id', 'title', 'type', 'status', 'created_at')
                    ->latest()
                    ->take(5);
            }]);
        });
        
        return view('student.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        // Validation des données
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Gestion de la photo de profil
        if ($request->hasFile('profile_photo')) {
            // Supprimer l'ancienne photo si elle existe et n'est pas l'avatar par défaut
            if ($user->profile_photo && $user->profile_photo !== 'profile-photos/default-avatar.jpg') {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Générer un nom unique pour la nouvelle photo
            $filename = time() . '_' . uniqid() . '.' . $request->profile_photo->extension();
            
            // Stocker la nouvelle photo
            $request->profile_photo->storeAs('profile-photos', $filename, 'public');
            
            // Mettre à jour le chemin complet de la photo dans la base de données
            $validated['profile_photo'] = 'profile-photos/' . $filename;
        }

        // Mettre à jour les informations de l'utilisateur
        $user->update($validated);

        return redirect()->route('student.profile')
            ->with('success', 'Votre profil a été mis à jour avec succès.');
    }

    public function documents()
    {
        $documents = auth()->user()->documents()->latest()->paginate(10);
        return view('student.documents.index', compact('documents'));
    }

    public function uploadDocument(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:inscription,attestation,other'],
            'file' => ['required', 'file', 'max:2048'],
        ]);

        $filePath = $request->file('file')->store('documents', 'public');

        auth()->user()->documents()->create([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'file_path' => $filePath,
            'status' => 'pending',
        ]);

        return redirect()->route('student.documents')
            ->with('success', 'Document téléchargé avec succès.');
    }

    public function notes(Request $request)
    {
        $semester = $request->get('semester');
        
        $query = auth()->user()->notes()->with('course');
        
        if ($semester) {
            $query->whereHas('course', function ($q) use ($semester) {
                $q->where('semester', $semester);
            });
        }

        $notes = $query->latest()->paginate(10);
        
        return view('student.notes.index', compact('notes', 'semester'));
    }

    public function announcements()
    {
        $announcements = Announcement::with('user')
            ->where(function($query) {
                $query->whereNull('expiry_date')
                      ->orWhere('expiry_date', '>', now());
            })
            ->orderBy('is_important', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('student.announcements', compact('announcements'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        auth()->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->route('student.profile')
            ->with('success', 'Mot de passe modifié avec succès.');
    }
} 