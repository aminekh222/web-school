@extends('layouts.app')

@section('title', 'Mes attestations')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Mes attestations</h2>

        @if($attestations->isEmpty())
            <p class="text-gray-500">Vous n'avez pas encore d'attestations.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($attestations as $attestation)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $attestation->type_attestation }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $attestation->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $attestation->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($attestation->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                           'bg-red-100 text-red-800') }}">
                                        {{ $attestation->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('student.attestations.show', $attestation) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Voir</a>
                                    @if($attestation->status === 'approved')
                                        <a href="{{ route('student.attestations.generate-pdf', $attestation) }}" class="text-green-600 hover:text-green-900">Télécharger PDF</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $attestations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 