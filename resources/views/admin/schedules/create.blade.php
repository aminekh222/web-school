@extends('layouts.app')

@section('title', 'Ajouter un cours à l\'emploi du temps')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Ajouter un cours à l'emploi du temps</h2>
            <a href="{{ route('admin.schedules.index') }}" class="text-indigo-600 hover:text-indigo-900">
                Retour à la liste
            </a>
        </div>

        <form action="{{ route('admin.schedules.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="course_id" class="block text-sm font-medium text-gray-700">Cours</label>
                    <select name="course_id" id="course_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Sélectionnez un cours</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="classroom_id" class="block text-sm font-medium text-gray-700">Salle</label>
                    <select name="classroom_id" id="classroom_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Sélectionnez une salle</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>
                                {{ $classroom->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('classroom_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="day_of_week" class="block text-sm font-medium text-gray-700">Jour de la semaine</label>
                    <select name="day_of_week" id="day_of_week" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Sélectionnez un jour</option>
                        @foreach(['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'] as $day)
                            <option value="{{ $day }}" {{ old('day_of_week') == $day ? 'selected' : '' }}>
                                {{ $day }}
                            </option>
                        @endforeach
                    </select>
                    @error('day_of_week')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="semester" class="block text-sm font-medium text-gray-700">Semestre</label>
                    <select name="semester" id="semester" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Sélectionnez un semestre</option>
                        <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>Semestre 1</option>
                        <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>Semestre 2</option>
                    </select>
                    @error('semester')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700">Heure de début</label>
                    <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('start_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_time" class="block text-sm font-medium text-gray-700">Heure de fin</label>
                    <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    @error('end_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Ajouter le cours
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 