@extends('layouts.app')

@section('title', 'Génération en Masse')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Génération en Masse d'Attestations</h1>

        <form action="{{ route('admin.attestations.generate-mass') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
            @csrf

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
                <div class="flex items-center justify-between mb-4">
                    <label class="block text-gray-700 text-sm font-bold">
                        Sélectionner les Étudiants
                    </label>
                    <div class="flex items-center">
                        <input type="checkbox" id="select-all" class="mr-2">
                        <label for="select-all" class="text-sm text-gray-600">Tout sélectionner</label>
                    </div>
                </div>
                <div class="border rounded-lg p-4 max-h-96 overflow-y-auto">
                    @foreach($students as $student)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" 
                                   name="student_ids[]" 
                                   value="{{ $student->id }}"
                                   class="student-checkbox mr-2">
                            <label class="text-gray-700">{{ $student->name }}</label>
                        </div>
                    @endforeach
                </div>
                @error('student_ids')
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
                    Générer les Attestations
                </button>
                <a href="{{ route('admin.attestations.index') }}" class="text-gray-600 hover:text-gray-800">
                    Retour à la liste
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all');
    const studentCheckboxes = document.querySelectorAll('.student-checkbox');

    selectAllCheckbox.addEventListener('change', function() {
        studentCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    studentCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(studentCheckboxes).every(cb => cb.checked);
            selectAllCheckbox.checked = allChecked;
        });
    });
});
</script>
@endpush
@endsection 