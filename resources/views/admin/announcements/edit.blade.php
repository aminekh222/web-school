@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Modifier l'Annonce</h2>
                    <a href="{{ route('admin.announcements.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        Retour
                    </a>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $announcement->title) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">Contenu</label>
                        <textarea name="content" id="content" rows="5" required
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('content', $announcement->content) }}</textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_important" id="is_important" value="1" 
                               {{ old('is_important', $announcement->is_important) ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="is_important" class="ml-2 block text-sm text-gray-700">
                            Marquer comme important
                        </label>
                    </div>

                    <div>
                        <label for="expiry_date" class="block text-sm font-medium text-gray-700">Date d'expiration (optionnel)</label>
                        <input type="datetime-local" name="expiry_date" id="expiry_date" 
                               value="{{ old('expiry_date', $announcement->expiry_date ? $announcement->expiry_date->format('Y-m-d\TH:i') : '') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <p class="mt-1 text-sm text-gray-500">
                            Laissez vide si l'annonce n'a pas de date d'expiration
                        </p>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Mettre à jour l'annonce
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 