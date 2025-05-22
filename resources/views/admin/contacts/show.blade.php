@extends('layouts.app')

@section('title', 'Détails du message')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Détails du message</h2>
            <a href="{{ route('admin.contacts.index') }}" class="text-indigo-600 hover:text-indigo-900">
                Retour à la liste
            </a>
        </div>

        <div class="bg-gray-50 rounded-lg p-6 mb-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">{{ $contact->subject }}</h3>
                    <p class="text-sm text-gray-500">De : {{ $contact->student->name }}</p>
                    <p class="text-sm text-gray-500">Envoyé le {{ $contact->created_at->format('d/m/Y à H:i') }}</p>
                </div>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                    {{ $contact->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                       ($contact->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 
                       'bg-green-100 text-green-800') }}">
                    {{ $contact->status }}
                </span>
            </div>

            <div class="prose max-w-none">
                <p class="text-gray-700">{{ $contact->message }}</p>
            </div>
        </div>

        @if($contact->response)
            <div class="bg-green-50 rounded-lg p-6 mb-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Votre réponse précédente</h4>
                <p class="text-gray-700">{{ $contact->response }}</p>
                <p class="text-sm text-gray-500 mt-2">Envoyée le {{ $contact->response_date->format('d/m/Y à H:i') }}</p>
            </div>
        @endif

        <form action="{{ route('admin.contacts.update', $contact) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="pending" {{ $contact->status === 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="in_progress" {{ $contact->status === 'in_progress' ? 'selected' : '' }}>En cours</option>
                    <option value="resolved" {{ $contact->status === 'resolved' ? 'selected' : '' }}>Résolu</option>
                </select>
            </div>

            <div>
                <label for="response" class="block text-sm font-medium text-gray-700">Réponse</label>
                <textarea name="response" id="response" rows="6" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('response', $contact->response) }}</textarea>
                @error('response')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Envoyer la réponse
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 