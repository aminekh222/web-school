@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Gestion des Attestations</h1>
        <div class="space-x-4">
            <a href="{{ route('admin.attestations.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Nouvelle Attestation
            </a>
            <a href="{{ route('admin.attestations.mass-generate') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Génération en Masse
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Numéro</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étudiant</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($attestations as $attestation)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $attestation->numero_attestation }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $attestation->student->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $attestation->type_attestation }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $attestation->date_emission->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $attestation->statut === 'validée' ? 'bg-green-100 text-green-800' : 
                                   ($attestation->statut === 'rejetée' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ $attestation->statut }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.attestations.show', $attestation) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Voir</a>
                            <a href="{{ route('admin.attestations.generate-pdf', $attestation) }}" class="text-green-600 hover:text-green-900">PDF</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $attestations->links() }}
    </div>
</div>
@endsection 