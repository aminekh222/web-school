@extends('layouts.app')

@section('title', 'Notes – ' . $course->name)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-lg p-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 gap-4">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-1">Notes – {{ $course->name }}</h2>
                    <p class="text-base text-gray-600">Semestre {{ $course->semester }}</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.notes.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow flex items-center transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Ajouter une note
                    </a>
                    <a href="{{ route('admin.notes.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow flex items-center transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        Retour
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="min-w-full bg-white divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Étudiant</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Note</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Commentaire</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($notes as $note)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $note->user->name ?? 'Inconnu' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($note->type == 'exam') Examen
                                    @elseif($note->type == 'tp') TP
                                    @elseif($note->type == 'project') Projet
                                    @else {{ ucfirst($note->type) }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($note->value, 2) }}/20</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $note->comment }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.notes.edit', $note) }}" class="text-indigo-600 hover:text-indigo-900 font-medium mr-3">Éditer</a>
                                    <form action="{{ route('admin.notes.destroy', $note) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium" onclick="return confirm('Supprimer cette note ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-400 py-8">Aucune note pour ce cours.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 