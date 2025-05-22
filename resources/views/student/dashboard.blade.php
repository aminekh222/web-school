@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@section('title', 'Tableau de bord étudiant')

@section('content')
    <div class="space-y-6">
        <!-- En-tête avec informations de l'étudiant -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">Bienvenue, {{ auth()->user()->name }}</h1>
                        <p class="mt-1 text-sm text-gray-500">Voici un aperçu de votre activité récente</p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <a href="{{ route('student.profile') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Modifier mon profil
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dernières annonces -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-medium text-gray-900">Dernières annonces</h2>
                    <a href="{{ route('student.announcements') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                        Voir toutes les annonces
                    </a>
                </div>
                @if($latestAnnouncements->count() > 0)
                    <div class="space-y-4">
                        @foreach($latestAnnouncements as $announcement)
                            <div class="border rounded-lg p-4 {{ $announcement->is_important ? 'bg-red-50 border-red-200' : 'bg-white border-gray-200' }}">
                                <div class="flex items-start">
                                    @if($announcement->is_important)
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="{{ $announcement->is_important ? 'ml-3' : '' }}">
                                        <h3 class="text-sm font-medium {{ $announcement->is_important ? 'text-red-800' : 'text-gray-900' }}">
                                            {{ $announcement->title }}
                                        </h3>
                                        <div class="mt-2 text-sm {{ $announcement->is_important ? 'text-red-700' : 'text-gray-600' }}">
                                            {{ Str::limit($announcement->content, 150) }}
                                        </div>
                                        <div class="mt-2 text-xs {{ $announcement->is_important ? 'text-red-600' : 'text-gray-500' }}">
                                            Par {{ $announcement->user->name }} • {{ $announcement->created_at->format('d/m/Y H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">Aucune annonce disponible pour le moment.</p>
                @endif
            </div>
        </div>

        <!-- Dernières notes -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-medium text-gray-900">Dernières notes</h2>
                    <a href="{{ route('student.notes') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                        Voir toutes les notes
                    </a>
                </div>
                @if($notes->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cours</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Note</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semestre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($notes as $note)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $note->course->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $note->value }}/20
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $note->semester }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $note->published_at ? $note->published_at->format('d/m/Y') : 'Non publiée' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-sm">Aucune note disponible pour le moment.</p>
                @endif
            </div>
        </div>

        <!-- Documents récents -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-medium text-gray-900">Documents récents</h2>
                    <a href="{{ route('student.documents') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                        Gérer mes documents
                    </a>
                </div>
                @if($documents->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($documents as $document)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $document->title }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ ucfirst($document->type) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $document->status === 'verified' ? 'bg-green-100 text-green-800' : 
                                                   ($document->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ $document->status === 'verified' ? 'Vérifié' : 
                                                   ($document->status === 'rejected' ? 'Rejeté' : 'En attente') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $document->created_at->format('d/m/Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-sm">Aucun document téléchargé pour le moment.</p>
                @endif
            </div>
        </div>
    </div>
@endsection 