@extends('layouts.app')

@section('title', 'Gestion des emplois du temps')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Emplois du temps</h2>
            <a href="{{ route('admin.schedules.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                Ajouter un cours
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cours</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Salle</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jour</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horaire</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semestre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($schedules as $schedule)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $schedule->course->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $schedule->classroom->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $schedule->day_of_week }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $schedule->start_time->format('H:i') }} - {{ $schedule->end_time->format('H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Semestre {{ $schedule->semester }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.schedules.edit', $schedule) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Modifier</a>
                            <form action="{{ route('admin.schedules.destroy', $schedule) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet emploi du temps ?')">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $schedules->links() }}
        </div>
    </div>
</div>
@endsection 