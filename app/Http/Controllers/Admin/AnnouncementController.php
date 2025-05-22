<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with(['user:id,name'])
            ->select('id', 'user_id', 'title', 'content', 'is_important', 'expiry_date', 'created_at')
            ->orderBy('is_important', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_important' => 'boolean',
            'expiry_date' => 'nullable|date|after:now',
        ]);

        $announcement = new Announcement($request->all());
        $announcement->user_id = auth()->id();
        $announcement->save();

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Annonce créée avec succès.');
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_important' => 'boolean',
            'expiry_date' => 'nullable|date|after:now',
        ]);

        $announcement->update($request->all());

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Annonce mise à jour avec succès.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Annonce supprimée avec succès.');
    }
} 