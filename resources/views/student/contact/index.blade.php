@extends('layouts.app')

@section('title', 'Contact Administration')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Contact Administration</h2>
            <a href="{{ route('student.contact.history') }}" class="text-indigo-600 hover:text-indigo-900">
                Voir l'historique
            </a>
        </div>

        <form action="{{ route('student.contact.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700">Sujet</label>
                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('subject')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="6" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('message') }}</textarea>
                @error('message')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Envoyer le message
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 