@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
<div class="container mx-auto px-4 py-8 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto">
        <!-- En-tête du profil -->
        <div class="bg-white shadow-lg rounded-xl p-8 mb-8 transform transition-all duration-300 hover:shadow-xl">
            <div class="flex items-center space-x-6">
                <div class="relative group">
                    <div class="absolute inset-0 bg-blue-500 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    <img src="{{ auth()->user()->profile_photo_url }}" 
                         alt="Photo de profil" 
                         class="w-28 h-28 rounded-full object-cover border-4 border-white shadow-md"
                         onerror="this.src='{{ asset('storage/profile-photos/default-avatar.jpg') }}'">
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-1">{{ auth()->user()->name }}</h1>
                    <p class="text-gray-600 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Formulaire de mise à jour -->
        <div class="bg-white shadow-lg rounded-xl p-8 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-gray-200">Modifier mes informations</h2>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Photo de profil -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Photo de profil</label>
                        <div class="flex items-center space-x-4">
                            <input type="file" 
                                   name="profile_photo" 
                                   accept="image/*"
                                   class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-blue-50 file:text-blue-700
                                          hover:file:bg-blue-100
                                          transition-colors duration-200">
                            <p class="text-sm text-gray-500">PNG, JPG jusqu'à 2MB</p>
                        </div>
                        @error('profile_photo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nom -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name', auth()->user()->name) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" 
                               value="{{ auth()->user()->email }}"
                               disabled
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-50 text-gray-500">
                        <p class="mt-1 text-sm text-gray-500">L'email ne peut pas être modifié</p>
                    </div>

                    <!-- Téléphone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                        <input type="tel" 
                               name="phone" 
                               value="{{ old('phone', auth()->user()->phone) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Adresse -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                        <textarea name="address" 
                                  rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">{{ old('address', auth()->user()->address) }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-200">
                    <button type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>

        <!-- Changement de mot de passe -->
        <div class="bg-white shadow-lg rounded-xl p-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b border-gray-200">Changer le mot de passe</h2>
            
            <form action="{{ route('student.password.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe actuel</label>
                        <input type="password" 
                               name="current_password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nouveau mot de passe</label>
                        <input type="password" 
                               name="password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                        <input type="password" 
                               name="password_confirmation"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-200">
                    <button type="submit" 
                            class="px-6 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors duration-200">
                        Changer le mot de passe
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 