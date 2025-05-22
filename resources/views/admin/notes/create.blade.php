@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-lg p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Ajouter une note</h2>
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.notes.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Étudiant</label>
                    <select name="user_id" id="user_id" required class="mt-1 block w-full rounded-md border-gray-300">
                        <option value="">Sélectionnez un étudiant</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('user_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="course_id" class="block text-sm font-medium text-gray-700">Cours</label>
                    <select name="course_id" id="course_id" required class="mt-1 block w-full rounded-md border-gray-300">
                        <option value="">Sélectionnez un cours</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }} (Semestre {{ $course->semester }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="value" class="block text-sm font-medium text-gray-700">Note</label>
                    <input type="number" step="0.01" min="0" max="20" name="value" id="value" value="{{ old('value') }}" required class="mt-1 block w-full rounded-md border-gray-300">
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type" id="type" required class="mt-1 block w-full rounded-md border-gray-300">
                        <option value="">Sélectionnez un type</option>
                        <option value="exam" {{ old('type') == 'exam' ? 'selected' : '' }}>Examen</option>
                        <option value="tp" {{ old('type') == 'tp' ? 'selected' : '' }}>TP</option>
                        <option value="project" {{ old('type') == 'project' ? 'selected' : '' }}>Projet</option>
                    </select>
                </div>
                <div>
                    <label for="semester" class="block text-sm font-medium text-gray-700">Semestre</label>
                    <select name="semester" id="semester" required class="mt-1 block w-full rounded-md border-gray-300">
                        <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>Semestre 1</option>
                        <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>Semestre 2</option>
                    </select>
                </div>
                <div>
                    <label for="comment" class="block text-sm font-medium text-gray-700">Commentaire</label>
                    <textarea name="comment" id="comment" rows="2" class="mt-1 block w-full rounded-md border-gray-300">{{ old('comment') }}</textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Ajouter la note
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 