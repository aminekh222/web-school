@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Gestion des Annonces</h2>
                    <a href="{{ route('admin.announcements.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Nouvelle annonce
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="overflow-x-auto bg-white rounded-lg shadow overflow-y-auto relative">
                    <table class="border-collapse table-auto w-full bg-white">
                        <thead>
                            <tr class="text-left">
                                <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">Titre</th>
                                <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">Auteur</th>
                                <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">Statut</th>
                                <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">Date d'expiration</th>
                                <th class="bg-gray-50 sticky top-0 border-b border-gray-100 px-6 py-3 text-gray-500 font-bold tracking-wider uppercase text-xs">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($announcements as $announcement)
                                <tr class="text-gray-700">
                                    <td class="border-b border-gray-100 px-6 py-4">
                                        <div class="flex items-center">
                                            @if($announcement->is_important)
                                                <span class="mr-2 flex-shrink-0">
                                                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            @endif
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $announcement->title }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ Str::limit($announcement->content, 50) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-b border-gray-100 px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $announcement->user->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $announcement->created_at->format('d/m/Y H:i') }}</div>
                                    </td>
                                    <td class="border-b border-gray-100 px-6 py-4">
                                        @if($announcement->is_important)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Important
                                            </span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Normal
                                            </span>
                                        @endif
                                    </td>
                                    <td class="border-b border-gray-100 px-6 py-4">
                                        @if($announcement->expiry_date)
                                            <span class="text-sm text-gray-500">
                                                {{ $announcement->expiry_date->format('d/m/Y') }}
                                            </span>
                                        @else
                                            <span class="text-sm text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="border-b border-gray-100 px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('admin.announcements.edit', $announcement) }}" class="text-indigo-600 hover:text-indigo-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="border-b border-gray-100 px-6 py-4 text-center text-gray-500">
                                        Aucune annonce n'a été créée
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 