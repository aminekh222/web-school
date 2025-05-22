@extends('layouts.app')

@section('title', 'Tableau de bord administrateur')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Dashboard Administrateur</h1>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total étudiants -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-lg font-semibold text-gray-700 mb-2">Total Étudiants</div>
                    <div class="text-3xl font-bold text-indigo-600">{{ $stats['total_students'] }}</div>
                    <div class="text-sm text-gray-500 mt-2">
                        Dont {{ $stats['active_students'] }} actifs
                    </div>
                </div>
            </div>

            <!-- Total cours -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-lg font-semibold text-gray-700 mb-2">Total Cours</div>
                    <div class="text-3xl font-bold text-indigo-600">{{ $stats['total_courses'] }}</div>
                </div>
            </div>

            <!-- Total documents -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-lg font-semibold text-gray-700 mb-2">Documents</div>
                    <div class="text-3xl font-bold text-indigo-600">{{ $stats['total_documents'] }}</div>
                </div>
            </div>

            <!-- Total notes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-lg font-semibold text-gray-700 mb-2">Notes</div>
                    <div class="text-3xl font-bold text-indigo-600">{{ $stats['total_notes'] }}</div>
                    <div class="text-sm text-gray-500 mt-2">
                        Moyenne générale: {{ number_format($stats['average_note'], 2) }}/20
                    </div>
                </div>
            </div>

            <!-- Total attestations -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-lg font-semibold text-gray-700 mb-2">Attestations</div>
                    <div class="text-3xl font-bold text-indigo-600">{{ $stats['total_attestations'] }}</div>
                    <div class="text-sm text-gray-500 mt-2">
                        {{ $stats['attestations_en_attente'] }} en attente
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Actions rapides</h2>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <a href="{{ route('admin.students.create') }}" class="btn-primary text-center">
                        Ajouter un étudiant
                    </a>
                    <a href="{{ route('admin.students.index') }}" class="btn-secondary text-center">
                        Gérer les étudiants
                    </a>
                    <a href="{{ route('admin.courses.index') }}" class="btn-secondary text-center">
                        Gérer les cours
                    </a>
                    <a href="{{ route('admin.notes.index') }}" class="btn-secondary text-center">
                        Gérer les notes
                    </a>
                    <a href="{{ route('admin.announcements.create') }}" class="btn-primary text-center">
                        Nouvelle annonce
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <a href="{{ route('admin.attestations.create') }}" class="btn-primary text-center">
                        Nouvelle attestation
                    </a>
                    <a href="{{ route('admin.attestations.mass-generate') }}" class="btn-secondary text-center">
                        Génération en masse d'attestations
                    </a>
                </div>
            </div>
        </div>

        <!-- Dernières annonces -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Dernières annonces</h2>
                    <a href="{{ route('admin.announcements.index') }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                        Voir toutes les annonces
                    </a>
                </div>
                @if(count($latestAnnouncements) > 0)
                    <div class="space-y-4">
                        @foreach($latestAnnouncements as $announcement)
                            <div class="border rounded-lg p-4 {{ $announcement->is_important ? 'bg-red-50 border-red-200' : 'bg-white border-gray-200' }}">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                            @if($announcement->is_important)
                                                <svg class="h-5 w-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                            {{ $announcement->title }}
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ Str::limit($announcement->content, 150) }}
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.announcements.edit', $announcement) }}" class="text-indigo-600 hover:text-indigo-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="mt-2 text-xs text-gray-500 flex items-center justify-between">
                                    <div>
                                        Par {{ $announcement->user->name }} • {{ $announcement->created_at->format('d/m/Y H:i') }}
                                    </div>
                                    @if($announcement->expiry_date)
                                        <div>
                                            Expire le {{ $announcement->expiry_date->format('d/m/Y') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm italic">Aucune annonce n'a été créée</p>
                @endif
            </div>
        </div>

        <!-- Dernières notes -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Dernières notes</h2>
                    <a href="{{ route('admin.notes.create') }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                        + Ajouter une note
                    </a>
                </div>
                @if(count($latestNotes) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étudiant</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cours</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Note</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($latestNotes as $note)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $note->user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $note->course->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $note->value >= 10 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ number_format($note->value, 2) }}/20
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ ucfirst($note->type) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $note->created_at->format('d/m/Y H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-sm italic">Aucune note n'a encore été ajoutée</p>
                @endif
            </div>
        </div>

        <!-- Dernières attestations -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Dernières attestations</h2>
                    <a href="{{ route('admin.attestations.index') }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                        Voir toutes les attestations
                    </a>
                </div>
                @if(count($latestAttestations) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Numéro</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Étudiant</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($latestAttestations as $attestation)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $attestation->numero_attestation }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $attestation->student->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ ucfirst($attestation->type_attestation) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $attestation->statut === 'validée' ? 'bg-green-100 text-green-800' : 
                                                   ($attestation->statut === 'rejetée' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ $attestation->statut }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $attestation->created_at->format('d/m/Y H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-sm italic">Aucune attestation n'a été générée</p>
                @endif
            </div>
        </div>

        <!-- Dernières activités -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Dernières activités</h2>
                <div class="text-gray-600">
                    <!-- À implémenter : Liste des dernières activités -->
                    <p class="text-sm italic">Les dernières activités seront affichées ici</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 