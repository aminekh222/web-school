@extends('layouts.app')

@section('title', 'Mon emploi du temps')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Mon emploi du temps</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach(['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'] as $day)
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">{{ $day }}</h3>
                    
                    @if(isset($schedules[$day]) && $schedules[$day]->count() > 0)
                        <div class="space-y-4">
                            @foreach($schedules[$day] as $schedule)
                                <div class="bg-white p-4 rounded-md shadow-sm">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $schedule->course->name ?? 'Cours supprimé' }}</h4>
                                            <p class="text-sm text-gray-600">{{ $schedule->start_time ? $schedule->start_time->format('H:i') : '' }} - {{ $schedule->end_time ? $schedule->end_time->format('H:i') : '' }}</p>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $schedule->classroom->name }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">Aucun cours programmé</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 