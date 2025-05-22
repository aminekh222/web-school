<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('student')
            ->latest()
            ->paginate(10);

        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
            'response' => 'required|string',
        ]);

        $contact->update([
            'status' => $validated['status'],
            'response' => $validated['response'],
            'response_date' => now(),
        ]);

        return redirect()->route('admin.contacts.index')
            ->with('success', 'Réponse envoyée avec succès.');
    }
} 