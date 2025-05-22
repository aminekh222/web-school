@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Détails de l'Attestation</h1>
            <div class="space-x-4">
                <a href="{{ route('admin.attestations.generate-pdf', $attestation) }}" 
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Télécharger PDF
                </a>
                <a href="{{ route('admin.attestations.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Retour à la liste
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h2 class="text-lg font-semibold mb-4">Informations Générales</h2>
                    <div class="space-y-2">
                        <p><span class="font-medium">Numéro :</span> {{ $attestation->numero }}</p>
                        <p><span class="font-medium">Type :</span> {{ $attestation->type_attestation }}</p>
                        <p><span class="font-medium">Date d'émission :</span> {{ $attestation->date_emission->format('d/m/Y') }}</p>
                        <p>
                            <span class="font-medium">Statut :</span>
                            <span class="px-2 py-1 rounded text-sm
                                @if($attestation->statut === 'validée') bg-green-100 text-green-800
                                @elseif($attestation->statut === 'rejetée') bg-red-100 text-red-800
                                @else bg-yellow-100 text-yellow-800
                                @endif">
                                {{ $attestation->statut }}
                            </span>
                        </p>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-semibold mb-4">Informations Étudiant</h2>
                    <div class="space-y-2">
                        <p><span class="font-medium">Nom :</span> {{ $attestation->student->name }}</p>
                        <p><span class="font-medium">Email :</span> {{ $attestation->student->email }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-semibold mb-4">Contenu de l'Attestation</h2>
                <div class="bg-gray-50 p-4 rounded-lg whitespace-pre-wrap">
                    {{ $attestation->contenu }}
                </div>
            </div>

            @if($attestation->pdf_path)
            <div class="mt-6">
                <h2 class="text-lg font-semibold mb-4">Fichier PDF</h2>
                <a href="{{ asset('storage/' . $attestation->pdf_path) }}" 
                   target="_blank"
                   class="text-blue-500 hover:text-blue-700">
                    Voir le PDF
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 