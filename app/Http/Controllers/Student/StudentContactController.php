<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class StudentContactController extends Controller
{
    public function index()
    {
        return view('student.contact.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = Contact::create([
            'student_id' => auth()->id(),
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        return redirect()->route('student.contact.history')
            ->with('success', 'Votre message a été envoyé avec succès.');
    }

    public function history()
    {
        $contacts = Contact::where('student_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('student.contact.history', compact('contacts'));
    }
} 