<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $students = User::where('role', 'student')->get();
        return view('admin.documents.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:inscription,attestation,autre',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'student_id' => 'required|exists:users,id'
        ]);

        $path = $request->file('file')->store('documents', 'public');

        $document = Document::create([
            'title' => $request->title,
            'type' => $request->type,
            'file_path' => $path,
            'user_id' => $request->student_id,
            'status' => 'approved', // Les documents créés par l'admin sont automatiquement approuvés
        ]);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Document créé avec succès.');
    }

    public function approve(Document $document)
    {
        $document->update([
            'status' => 'approved'
        ]);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Document approuvé avec succès.');
    }

    public function reject(Document $document)
    {
        $document->update([
            'status' => 'rejected'
        ]);

        return redirect()->route('admin.documents.index')
            ->with('success', 'Document rejeté avec succès.');
    }

    public function download(Document $document)
    {
        $file = storage_path('app/public/' . $document->file_path);
        if (!file_exists($file)) {
            abort(404, 'Fichier non trouvé');
        }
        return response()->download($file, $document->title . '.' . pathinfo($file, PATHINFO_EXTENSION));
    }
} 