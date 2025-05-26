@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6 mb-6">
                <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-gray-200">
                    @if(auth()->user()->profile_photo)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" 
                             alt="Photo de profil" 
                             class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('storage/profile-photos/default-avatar.jpg') }}" 
                             alt="Photo de profil par défaut" 
                             class="w-full h-full object-cover">
                    @endif
                </div>
                <div>
                    <h1 class="text-2xl font-bold">{{ auth()->user()->name }}</h1>
                    <p class="text-gray-600">{{ auth()->user()->email }}</p>
                </div>
            </div>

            <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="profile_photo" class="block text-sm font-medium text-gray-700">Photo de profil</label>
                    <div class="mt-1 flex items-center space-x-4">
                        <input type="file" 
                               name="profile_photo" 
                               id="profile_photo" 
                               accept="image/*"
                               class="block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100">
                        <p class="text-sm text-gray-500">PNG, JPG jusqu'à 2MB</p>
                    </div>
                    @error('profile_photo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', auth()->user()->name) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" 
                           id="email" 
                           value="{{ auth()->user()->email }}"
                           disabled
                           class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm">
                    <p class="mt-1 text-sm text-gray-500">L'email ne peut pas être modifié</p>
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="text" 
                           name="phone" 
                           id="phone" 
                           value="{{ old('phone', auth()->user()->phone) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                    <textarea name="address" 
                              id="address" 
                              rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('address', auth()->user()->address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Mettre à jour le profil
                    </button>
                </div>
            </form>

            <!-- Section pour changer le mot de passe -->
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h2 class="text-lg font-semibold mb-4">Changer le mot de passe</h2>
                <form action="{{ route('student.password.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                        <input type="password" 
                               name="current_password" 
                               id="current_password"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                        <input type="password" 
                               name="password" 
                               id="password"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Changer le mot de passe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 