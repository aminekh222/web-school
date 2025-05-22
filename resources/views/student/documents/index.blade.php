@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Formulaire d'upload -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Uploader un Document</h2>
            
            <form action="{{ route('student.documents.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Titre du document</label>
                    <input type="text" name="title" id="title" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type de document</label>
                    <select name="type" id="type" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="inscription">Document d'inscription</option>
                        <option value="attestation">Attestation</option>
                        <option value="other">Autre</option>
                    </select>
                </div>

                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700">Fichier (Max: 2MB)</label>
                    <input type="file" name="file" id="file" required
                        class="mt-1 block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-md file:border-0
                        file:text-sm file:font-semibold
                        file:bg-gray-50 file:text-gray-700
                        hover:file:bg-gray-100">
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                        Uploader
                    </button>
                </div>
            </form>
        </div>

        <!-- Liste des documents -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Mes Documents</h2>

            @if($documents->isEmpty())
                <div class="text-center py-8">
                    <p class="text-gray-500">Aucun document uploadé pour le moment.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($documents as $document)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $document->title }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            @switch($document->type)
                                                @case('inscription')
                                                    Document d'inscription
                                                    @break
                                                @case('attestation')
                                                    Attestation
                                                    @break
                                                @default
                                                    Autre
                                            @endswitch
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if($document->status === 'approved')
                                                bg-green-100 text-green-800
                                            @elseif($document->status === 'rejected')
                                                bg-red-100 text-red-800
                                            @else
                                                bg-yellow-100 text-yellow-800
                                            @endif">
                                            @switch($document->status)
                                                @case('approved')
                                                    Approuvé
                                                    @break
                                                @case('rejected')
                                                    Rejeté
                                                    @break
                                                @default
                                                    En attente
                                            @endswitch
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $document->created_at ? $document->created_at->format('d/m/Y') : '' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ asset('storage/' . $document->file_path) }}" 
                                           target="_blank"
                                           class="text-indigo-600 hover:text-indigo-900">
                                            Télécharger
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $documents->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 