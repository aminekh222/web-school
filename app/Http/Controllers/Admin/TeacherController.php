<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Affiche la liste des enseignants
     */
    public function index()
    {
        return view('admin.teachers.index');
    }

    /**
     * Affiche le formulaire de création d'un enseignant
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Enregistre un nouvel enseignant
     */
    public function store(Request $request)
    {
        // Logique d'enregistrement à implémenter
        return redirect()->route('admin.teachers.index')
            ->with('success', 'Enseignant créé avec succès.');
    }

    /**
     * Affiche les détails d'un enseignant
     */
    public function show($id)
    {
        return view('admin.teachers.show', compact('id'));
    }

    /**
     * Affiche le formulaire d'édition d'un enseignant
     */
    public function edit($id)
    {
        return view('admin.teachers.edit', compact('id'));
    }

    /**
     * Met à jour un enseignant
     */
    public function update(Request $request, $id)
    {
        // Logique de mise à jour à implémenter
        return redirect()->route('admin.teachers.index')
            ->with('success', 'Enseignant mis à jour avec succès.');
    }

    /**
     * Supprime un enseignant
     */
    public function destroy($id)
    {
        // Logique de suppression à implémenter
        return redirect()->route('admin.teachers.index')
            ->with('success', 'Enseignant supprimé avec succès.');
    }
} 