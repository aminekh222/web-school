<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attestation;
use Illuminate\Http\Request;

class StudentAttestationController extends Controller
{
    public function index()
    {
        $attestations = Attestation::where('student_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('student.attestations.index', compact('attestations'));
    }

    public function show(Attestation $attestation)
    {
        // Vérifier que l'attestation appartient bien à l'étudiant connecté
        if ($attestation->student_id !== auth()->id()) {
            abort(403);
        }

        return view('student.attestations.show', compact('attestation'));
    }

    public function generatePDF(Attestation $attestation)
    {
        // Vérifier que l'attestation appartient bien à l'étudiant connecté
        if ($attestation->student_id !== auth()->id()) {
            abort(403);
        }

        // Utiliser le même code que dans le contrôleur admin pour générer le PDF
        $pdf = \PDF::loadView('attestations.pdf', compact('attestation'));
        return $pdf->download('attestation.pdf');
    }
} 