@extends('layouts.app')
@section('title', 'Bienvenue sur Web School')
@section('content')
<div class="relative min-h-screen bg-gray-50">
    <!-- Hero section -->
    <div class="relative overflow-hidden">
        <div class="absolute inset-y-0 h-full w-full" aria-hidden="true">
            <div class="relative h-full">
                <svg class="absolute right-full transform translate-y-1/3 translate-x-1/4 md:translate-y-1/2 sm:translate-x-1/2 lg:translate-x-full" width="404" height="784" fill="none" viewBox="0 0 404 784">
                    <defs>
                        <pattern id="e229dbec-10e9-49ee-8ec3-0286ca089edf" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                        </pattern>
                    </defs>
                    <rect width="404" height="784" fill="url(#e229dbec-10e9-49ee-8ec3-0286ca089edf)" />
                </svg>
                <svg class="absolute left-full transform -translate-y-3/4 -translate-x-1/4 sm:-translate-x-1/2 md:-translate-y-1/2 lg:-translate-x-3/4" width="404" height="784" fill="none" viewBox="0 0 404 784">
                    <defs>
                        <pattern id="d2a68204-c383-44b1-b99f-42ccff4e5365" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                            <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                        </pattern>
                    </defs>
                    <rect width="404" height="784" fill="url(#d2a68204-c383-44b1-b99f-42ccff4e5365)" />
                </svg>
            </div>
        </div>

        <div class="relative pt-6 pb-16 sm:pb-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="text-center">
                    <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                        <span class="block">Bienvenue sur</span>
                        <span class="block text-indigo-600">Web School</span>
                    </h1>
                    <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                        Votre plateforme de gestion scolaire complète et intuitive
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature section -->
    <div class="relative py-16 sm:py-24 lg:py-32">
        <div class="mx-auto max-w-md px-4 text-center sm:max-w-3xl sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Feature 1 -->
                <div class="pt-6">
                    <div class="flow-root rounded-lg bg-white px-6 pb-8">
                        <div class="-mt-6">
                            <div class="inline-flex items-center justify-center rounded-md bg-indigo-500 p-3 shadow-lg">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="mt-8 text-lg font-medium tracking-tight text-gray-900">Gestion des Cours</h3>
                            <p class="mt-5 text-base text-gray-500">
                                Gérez facilement les cours, les emplois du temps et les inscriptions des étudiants
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="pt-6">
                    <div class="flow-root rounded-lg bg-white px-6 pb-8">
                        <div class="-mt-6">
                            <div class="inline-flex items-center justify-center rounded-md bg-indigo-500 p-3 shadow-lg">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="mt-8 text-lg font-medium tracking-tight text-gray-900">Gestion des Documents</h3>
                            <p class="mt-5 text-base text-gray-500">
                                Système complet de gestion documentaire avec validation et suivi
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="pt-6">
                    <div class="flow-root rounded-lg bg-white px-6 pb-8">
                        <div class="-mt-6">
                            <div class="inline-flex items-center justify-center rounded-md bg-indigo-500 p-3 shadow-lg">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h3 class="mt-8 text-lg font-medium tracking-tight text-gray-900">Suivi des Étudiants</h3>
                            <p class="mt-5 text-base text-gray-500">
                                Suivez les progrès et la participation de chaque étudiant en temps réel
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-indigo-50">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-24 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 md:text-4xl">
                <span class="block">Prêt à commencer ?</span>
                <span class="block text-indigo-600">Connectez-vous à votre espace</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Se connecter
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
