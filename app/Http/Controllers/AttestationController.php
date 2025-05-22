<?php

namespace App\Http\Controllers;

use App\Models\Attestation;
use App\Models\User;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class AttestationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attestations = Attestation::with('student')->latest()->paginate(10);
        return view('attestations.index', compact('attestations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::where('role', 'student')->get();
        return view('attestations.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'type_attestation' => 'required|string',
            'contenu' => 'required|string',
        ]);

        $attestation = Attestation::create([
            'numero_attestation' => 'ATT-' . time(),
            'student_id' => $request->student_id,
            'type_attestation' => $request->type_attestation,
            'contenu' => $request->contenu,
            'date_emission' => Carbon::now(),
        ]);

        return redirect()->route('attestations.show', $attestation)
            ->with('success', 'Attestation créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attestation $attestation)
    {
        return view('attestations.show', compact('attestation'));
    }

    /**
     * Generate PDF for the specified attestation.
     */
    public function generatePDF(Attestation $attestation)
    {
        $pdf = PDF::loadView('attestations.pdf', compact('attestation'));
        return $pdf->download('attestation-' . $attestation->numero_attestation . '.pdf');
    }

    /**
     * Show the form for mass generation.
     */
    public function massGenerateForm()
    {
        $students = User::where('role', 'student')->get();
        return view('attestations.mass-generate', compact('students'));
    }

    /**
     * Generate multiple attestations.
     */
    public function generateMass(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:users,id',
            'type_attestation' => 'required|string',
            'contenu' => 'required|string',
        ]);

        $attestations = [];
        foreach ($request->student_ids as $studentId) {
            $attestation = Attestation::create([
                'numero_attestation' => 'ATT-' . time() . '-' . $studentId,
                'student_id' => $studentId,
                'type_attestation' => $request->type_attestation,
                'contenu' => $request->contenu,
                'date_emission' => Carbon::now(),
            ]);
            $attestations[] = $attestation;
        }

        return redirect()->route('attestations.index')
            ->with('success', count($attestations) . ' attestations ont été générées avec succès.');
    }
} 