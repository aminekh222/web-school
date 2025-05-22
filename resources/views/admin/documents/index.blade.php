@extends('layouts.app')

@section('title', 'Documents')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- En-tête -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Gestion des Documents</h2>
                    <a href="{{ route('admin.documents.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Créer un document
                    </a>
                </div>

                <!-- Message de succès -->
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Liste des documents -->
                @if($documents->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500">Aucun document n'a été uploadé pour le moment.</p>
                    </div>
                @else
                    <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étudiant</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($documents as $document)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $document->title }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $document->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $document->user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($document->type === 'inscription')
                                                    bg-purple-100 text-purple-800
                                                @elseif($document->type === 'attestation')
                                                    bg-blue-100 text-blue-800
                                                @else
                                                    bg-gray-100 text-gray-800
                                                @endif">
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
                                            </span>
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
                                            {{ $document->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-3">
                                                <!-- Bouton de téléchargement -->
                                                <a href="{{ route('admin.documents.download', $document) }}"
                                                   class="text-blue-600 hover:text-blue-900 flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                    </svg>
                                                    Télécharger
                                                </a>

                                                @if($document->status === 'pending')
                                                    <!-- Formulaire d'approbation -->
                                                    <form action="{{ route('admin.documents.approve', $document) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-green-600 hover:text-green-900 flex items-center">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                            Approuver
                                                        </button>
                                                    </form>

                                                    <!-- Formulaire de rejet -->
                                                    <form action="{{ route('admin.documents.reject', $document) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 flex items-center">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                            </svg>
                                                            Rejeter
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $documents->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 