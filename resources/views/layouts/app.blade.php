<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Web School') }} - @yield('title')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .dropdown-menu {
            display: none;
        }
        .dropdown-menu.active {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="bg-gradient-to-r from-indigo-600 to-indigo-800 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="text-white text-xl font-bold hover:text-indigo-200 transition duration-300">
                        Web School
                    </a>
                </div>

                <!-- Menu principal -->
                <div class="hidden sm:flex sm:items-center sm:space-x-4">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <!-- Tableau de bord -->
                            <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Tableau de bord</a>
                            
                            <!-- Gestion des utilisateurs -->
                            <div class="relative">
                                <button onclick="toggleDropdown('users-dropdown')" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium flex items-center transition duration-300">
                                    Utilisateurs
                                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div id="users-dropdown" class="dropdown-menu absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                    <div class="py-1">
                                        <a href="{{ route('admin.students.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-300">Étudiants</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Gestion académique -->
                            <div class="relative">
                                <button onclick="toggleDropdown('academic-dropdown')" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium flex items-center transition duration-300">
                                    Académique
                                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div id="academic-dropdown" class="dropdown-menu absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                    <div class="py-1">
                                        <a href="{{ route('admin.courses.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-300">Cours</a>
                                        <a href="{{ route('admin.notes.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-300">Notes</a>
                                        <a href="{{ route('admin.schedules.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-300">Emplois du temps</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Gestion administrative -->
                            <div class="relative">
                                <button onclick="toggleDropdown('admin-dropdown')" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium flex items-center transition duration-300">
                                    Administration
                                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div id="admin-dropdown" class="dropdown-menu absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                    <div class="py-1">
                                        <a href="{{ route('admin.documents.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-300">Documents</a>
                                        <a href="{{ route('admin.attestations.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-300">Attestations</a>
                                        <a href="{{ route('admin.announcements.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-300">Annonces</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Communication -->
                            <a href="{{ route('admin.contacts.index') }}" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium flex items-center transition duration-300">
                                <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Boîte de réception
                            </a>

                        @else
                            <!-- Menu étudiant -->
                            <a href="{{ route('student.dashboard') }}" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Tableau de bord</a>
                            <a href="{{ route('student.notes') }}" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Notes</a>
                            <a href="{{ route('student.documents') }}" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Documents</a>
                            <a href="{{ route('student.announcements') }}" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Annonces</a>
                            <a href="{{ route('student.schedule') }}" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Emploi du temps</a>
                            <a href="{{ route('student.attestations') }}" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Attestations</a>
                            <a href="{{ route('student.contact') }}" class="text-white hover:text-indigo-200 px-3 py-2 rounded-md text-sm font-medium transition duration-300">Contact</a>
                        @endif

                        <!-- Menu utilisateur -->
                        <div class="ml-3 flex items-center space-x-4 border-l border-indigo-500 pl-4">
                            @if(auth()->user()->isStudent())
                                <a href="{{ route('student.profile') }}" class="text-white hover:text-indigo-200 text-sm font-medium flex items-center transition duration-300">
                                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    {{ auth()->user()->name }}
                                </a>
                            @else
                                <span class="text-white text-sm font-medium flex items-center transition duration-300">
                                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    {{ auth()->user()->name }}
                                </span>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-white hover:text-indigo-200 text-sm font-medium flex items-center transition duration-300">
                                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium">Connexion</a>
                    @endauth
                </div>

                <!-- Menu mobile -->
                <div class="sm:hidden">
                    <button type="button" class="text-white hover:text-indigo-200">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-500 text-white p-4 rounded-lg">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <main class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <script>
        function toggleDropdown(dropdownId) {
            // Fermer tous les autres menus déroulants
            document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
                if (dropdown.id !== dropdownId) {
                    dropdown.classList.remove('active');
                }
            });

            // Basculer le menu déroulant cliqué
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('active');
        }

        // Fermer les menus déroulants quand on clique en dehors
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.relative')) {
                document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
                    dropdown.classList.remove('active');
                });
            }
        });
    </script>
</body>
</html> 