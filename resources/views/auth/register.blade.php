@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-gray-700">{{ __('Inscription') }}</h2>
            <p class="mt-2 text-sm text-gray-600">{{ __('Créez votre compte étudiant') }}</p>
        </div>

        @if ($errors->any())
            <div class="mb-4">
                <div class="font-medium text-red-600">
                    {{ __('Oups! Une erreur s\'est produite.') }}
                </div>

                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Nom -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    {{ __('Nom complet') }}
                </label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    {{ __('Email') }}
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Téléphone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">
                    {{ __('Téléphone') }}
                </label>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Adresse -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">
                    {{ __('Adresse') }}
                </label>
                <textarea id="address" name="address" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('address') }}</textarea>
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    {{ __('Mot de passe') }}
                </label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <!-- Confirmation du mot de passe -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                    {{ __('Confirmer le mot de passe') }}
                </label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                    {{ __('Déjà inscrit ?') }}
                </a>

                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('S\'inscrire') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 