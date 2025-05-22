@extends('layouts.app')

@section('title', 'Gestion des notes')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Gestion des notes</h2>
                <a href="{{ route('admin.notes.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                    + Ajouter une note
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $course->name }}</h3>
                        <p class="text-sm text-gray-600 mb-2">Semestre {{ $course->semester }}</p>
                        <p class="text-sm text-gray-500 mb-4">{{ $course->notes_count }} note(s)</p>
                        <a href="{{ route('admin.courses.notes', $course) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
                            Voir les notes
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 