@extends('layouts.app')

@section('title', 'Toutes les annonces')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Toutes les annonces</h1>

        @if($announcements->count() > 0)
            <div class="space-y-6">
                @foreach($announcements as $announcement)
                    <div class="border rounded-lg p-6 {{ $announcement->is_important ? 'bg-red-50 border-red-200' : 'bg-white border-gray-200' }}">
                        <div class="flex items-start">
                            @if($announcement->is_important)
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                            <div class="{{ $announcement->is_important ? 'ml-4' : '' }} flex-1">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-xl font-medium {{ $announcement->is_important ? 'text-red-800' : 'text-gray-900' }}">
                                        {{ $announcement->title }}
                                    </h2>
                                    <div class="text-sm {{ $announcement->is_important ? 'text-red-600' : 'text-gray-500' }}">
                                        @if($announcement->expiry_date)
                                            <span class="inline-flex items-center">
                                                <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Expire le {{ $announcement->expiry_date->format('d/m/Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-4 text-base {{ $announcement->is_important ? 'text-red-700' : 'text-gray-600' }}">
                                    {!! nl2br(e($announcement->content)) !!}
                                </div>
                                <div class="mt-4 flex items-center text-sm {{ $announcement->is_important ? 'text-red-600' : 'text-gray-500' }}">
                                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Par {{ $announcement->user->name }}
                                    <span class="mx-2">&bull;</span>
                                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Publié le {{ $announcement->created_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune annonce</h3>
                <p class="mt-1 text-sm text-gray-500">Il n'y a aucune annonce active pour le moment.</p>
            </div>
        @endif
    </div>
</div>
@endsection 