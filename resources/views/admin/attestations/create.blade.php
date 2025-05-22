@extends('layouts.app')

@section('title', 'Créer Attestation')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Créer une Attestation</h1>

        <form action="{{ route('admin.attestations.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="student_id">
                    Étudiant
                </label>
                <select name="student_id" id="student_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Sélectionnez un étudiant</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
                @error('student_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="type_attestation">
                    Type d'Attestation
                </label>
                <select name="type_attestation" id="type_attestation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="">Sélectionnez un type</option>
                    <option value="scolarité">Attestation de Scolarité</option>
                    <option value="réussite">Attestation de Réussite</option>
                    <option value="inscription">Attestation d'Inscription</option>
                </select>
                @error('type_attestation')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="contenu">
                    Contenu de l'Attestation
                </label>
                <textarea name="contenu" id="contenu" rows="6" 
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                          placeholder="Entrez le contenu de l'attestation. Utilisez {nom}, {prenom}, {classe} pour les variables."
                          required></textarea>
                @error('contenu')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
                <p class="text-sm text-gray-500 mt-2">
                    Variables disponibles : {nom}, {prenom}, {classe}
                </p>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Créer l'Attestation
                </button>
                <a href="{{ route('admin.attestations.index') }}" class="text-gray-600 hover:text-gray-800">
                    Retour à la liste
                </a>
            </div>
        </form>
    </div>
</div>
@endsection 