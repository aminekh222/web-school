<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;

class StudentManagementController extends Controller
{
    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'role' => 'student',
            'profile_photo' => 'profile-photos/default-avatar.jpg',
        ];

        if ($request->hasFile('profile_photo')) {
            $filename = time() . '_' . uniqid() . '.' . $request->profile_photo->extension();
            $request->profile_photo->storeAs('profile-photos', $filename, 'public');
            $userData['profile_photo'] = 'profile-photos/' . $filename;
        }

        $user = User::create($userData);

        return redirect()->route('admin.students.index')
            ->with('success', 'Étudiant créé avec succès.');
    }

    public function edit(User $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, User $student)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $student->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'is_active' => ['boolean'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        if ($request->hasFile('profile_photo')) {
            // Supprimer l'ancienne photo si elle existe et n'est pas l'avatar par défaut
            if ($student->profile_photo && $student->profile_photo !== 'profile-photos/default-avatar.jpg') {
                Storage::disk('public')->delete($student->profile_photo);
            }

            $filename = time() . '_' . uniqid() . '.' . $request->profile_photo->extension();
            $request->profile_photo->storeAs('profile-photos', $filename, 'public');
            $validated['profile_photo'] = 'profile-photos/' . $filename;
        }

        $student->update($validated);

        return redirect()->route('admin.students.index')
            ->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function destroy(User $student)
    {
        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Étudiant supprimé avec succès.');
    }

    public function toggleActive(User $student)
    {
        $student->update(['is_active' => !$student->is_active]);

        return redirect()->back()
            ->with('success', 'Statut de l\'étudiant mis à jour.');
    }
} 