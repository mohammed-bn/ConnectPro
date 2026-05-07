<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Professionnel - ConnectPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #FFB703;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #E5A500;
        }
        
        .dark .custom-scrollbar::-webkit-scrollbar-track {
            background: #374151;
        }
        
        .sidebar-scroll {
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            height: calc(100vh - 280px);
        }
        .sidebar-scroll::-webkit-scrollbar {
            display: none;
        }
        
        .filter-bar-hidden {
            max-height: 0;
            opacity: 0;
            padding-top: 0;
            padding-bottom: 0;
            border-width: 0;
            margin-bottom: 0;
            pointer-events: none;
            transition: all 0.3s ease-in-out;
        }
        .filter-bar-visible {
            max-height: 250px;
            opacity: 1;
            padding-top: 1rem;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
            pointer-events: auto;
            transition: all 0.3s ease-in-out;
        }
        
        .professional-card {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        
        .professional-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-color: #FFB703;
        }

        .main-content-scroll {
            height: calc(100vh - 64px);
            overflow-y: auto;
            scrollbar-width: thin;
        }
        
        .main-content-scroll::-webkit-scrollbar {
            width: 6px;
        }
        
        .main-content-scroll::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .main-content-scroll::-webkit-scrollbar-thumb {
            background: #FFB703;
            border-radius: 10px;
        }
        
        .main-content-scroll::-webkit-scrollbar-thumb:hover {
            background: #E5A500;
        }
        
        .dark .main-content-scroll::-webkit-scrollbar-track {
            background: #374151;
        }
        
        .theme-transition {
            transition: all 0.3s ease;
        }
        
        .post-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .post-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .toast-notification {
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
    
    <!-- HEADER / NAVBAR -->
    <nav class="fixed top-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-lg z-50 transition-colors">
        <div class="flex items-center justify-between px-6 py-3">
            
            <a href="{{ url('/') }}" class="flex items-center gap-3 transition-transform hover:scale-105">
                <div class="w-10 h-10 bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="font-bold text-xl text-[#0A2647] dark:text-white">ConnectPro</h1>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Espace professionnel</p>
                </div>
            </a>

            <div class="flex-1 max-w-2xl mx-6">
                <div class="flex items-center gap-2">
                    <div class="relative flex-1">
                        <input type="text" 
                               id="quickSearch"
                               placeholder="Recherche rapide..." 
                               class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition text-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <button onclick="toggleFilterBar()" id="filterToggleBtn" class="flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl text-sm text-gray-700 dark:text-gray-300 hover:shadow-md hover:border-[#FFB703] dark:hover:border-[#FFB703] transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        <span>Filtres</span>
                    </button>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <button id="darkModeToggle" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition theme-transition">
                    <svg id="darkModeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>
                
                <a href="{{route('profilePr')}}" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:text-[#FFB703] transition group">
                    <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-sm font-medium">{{ Auth::user()->name ?? 'Profil' }}</span>
                </a>

                <div class="h-6 w-px bg-gray-300 dark:bg-gray-600"></div>

                <form method="POST" action="{{route('logout')}}" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-4 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="text-sm font-medium">Déconnexion</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- NOTIFICATION TOAST -->
    <div id="notificationToast" class="fixed top-20 right-4 z-50 hidden transform transition-all duration-300 toast-notification">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-4 max-w-sm border-l-4 border-[#FFB703]">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#FFB703]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V5h2v4z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-800 dark:text-white">Notification</h4>
                    <p id="notificationMessage" class="text-sm text-gray-600 dark:text-gray-400"></p>
                </div>
                <button onclick="closeNotification()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="flex pt-16">
        
        <!-- SIDEBAR -->
        <aside class="fixed left-0 top-16 h-[calc(100vh-64px)] w-72 bg-white dark:bg-gray-800 shadow-2xl z-30 flex flex-col transition-colors">
            
            <div class="p-5 border-b border-gray-200 dark:border-gray-700">
                <div class="flex flex-col items-center text-center">
                    <div class="relative">
                        <img src="{{ Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'Jean Dupont').'&background=0A2647&color=FFB703&size=100' }}"
                             class="w-20 h-20 rounded-full object-cover border-4 border-[#FFB703] shadow-lg">
                        <div class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <h3 class="mt-3 font-bold text-[#0A2647] dark:text-white">{{ Auth::user()->name ?? 'Jean Dupont' }}</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Professionnel</p>
                    
                    <a href="{{ route('profilePrEdit') }}" class="mt-3 w-full flex items-center justify-center gap-1.5 px-3 py-1.5 text-xs font-medium text-[#0A2647] dark:text-white bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                        Modifier mon profil
                    </a>
                </div>
            </div>

            <div class="flex-1 sidebar-scroll p-4">
                <nav class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                        <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <span class="text-sm font-medium">Messages</span>
                        <span class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">3</span>
                    </a>

                    <a href="{{route('notification')}}" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                        <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="text-sm font-medium">Notifications</span>
                        <span class="ml-auto bg-[#FFB703] text-[#0A2647] text-xs px-2 py-0.5 rounded-full">2</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 bg-gray-100 dark:bg-gray-700 rounded-xl text-[#0A2647] dark:text-white">
                        <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <span class="text-sm font-medium">Publications</span>
                        <span class="ml-auto bg-[#FFB703] text-[#0A2647] text-xs px-2 py-0.5 rounded-full">{{ $posts->total() }}</span>
                    </a>
                    
                </nav>
            </div>

            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                    <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-sm font-medium">Paramètres</span>
                </a>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 ml-72 main-content-scroll">
            <div class="py-6 px-6">
                
                <!-- FILTER BAR -->
                <div id="filterBar" class="filter-bar-hidden bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 mb-4">
                    <div class="px-4 py-2">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Nom</label>
                                <input type="text" id="filterNom" placeholder="Nom du professionnel" class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Catégorie</label>
                                <input type="text" id="filterCategorie" placeholder="Catégorie" class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Spécialité</label>
                                <input type="text" id="filterSpecialite" placeholder="Spécialité" class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Ville</label>
                                <input type="text" id="filterVille" placeholder="Ville" class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none">
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-4 pt-3 border-t border-gray-100 dark:border-gray-700">
                            <button onclick="applyFilters()" class="px-4 py-1.5 bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] text-white text-sm rounded-lg hover:shadow-md transition flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Appliquer
                            </button>
                            <button onclick="toggleFilterBar()" class="text-xs text-gray-500 hover:text-[#FFB703] transition flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Fermer
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SEARCH RESULTS -->
                <div id="professionalsResults" class="mb-6 space-y-3 max-h-[400px] overflow-y-auto custom-scrollbar pr-2">
                </div>

                <!-- CREATE POST -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg mb-6 overflow-hidden">
                    <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-5 py-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <h2 class="text-lg font-semibold text-white">Créer une publication</h2>
                        </div>
                    </div>
                    <div class="p-4">
                        <form id="postForm" method="POST" action="{{ route('addPost') }}" enctype="multipart/form-data">
                            @csrf
                            <textarea name="description" id="postContent" rows="3"
                                      placeholder="Partagez une idée, un service, une actualité..."
                                      class="w-full p-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition resize-none text-sm">{{ old('description') }}</textarea>
                            
                            @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            
                            <div class="flex items-center justify-between mt-3">
                                <div class="flex items-center gap-3">
                                    <label for="postImage" class="cursor-pointer px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Ajouter une photo</span>
                                    </label>
                                    <input type="file" name="image" id="postImage" accept="image/*" class="hidden">
                                    <span id="fileName" class="text-xs text-gray-500 dark:text-gray-400"></span>
                                </div>
                                <button type="submit"
                                        class="px-6 py-2 bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] hover:from-[#1E4A6D] hover:to-[#2C7DA0] text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md flex items-center gap-2 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Publier
                                </button>
                            </div>
                            
                            @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </form>
                    </div>
                </div>

                <!-- SECTION FLUX DES PUBLICATIONS -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-[#0A2647] dark:text-white">📱 Flux d'actualités</h2>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Total: {{ $posts->total() }} publications</span>
                    </div>
                    
                    <div id="postsFeed" class="space-y-5 pb-10">
                        @forelse($posts as $post)
                        <div class="post-card bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-colors">
                            <div class="p-5">
                               
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-3">
                                       
                                        <img src="{{ $post->user->photo 
                                            ? asset('storage/'.$post->user->photo) 
                                            : 'https://ui-avatars.com/api/?name='.urlencode($post->user->name).'&background=0A2647&color=FFB703&size=50' }}" 
                                            class="w-12 h-12 rounded-full object-cover border-2 border-[#FFB703]">
                                        <div>
                                           
                                            <h3 class="font-bold text-gray-800 dark:text-white">{{ $post->user->name }}</h3>
                                            <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                                                <span>{{ $post->user->city ?? 'Ville non renseignée' }}</span>
                                                <span>•</span>
                                                <span>{{ $post->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- BOUTON VOIR PROFIL -->
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('professional.show', $post->user->id) }}" 
                                           class="flex items-center gap-1.5 px-3 py-1.5 bg-[#FFB703] text-[#0A2647] text-xs font-semibold rounded-lg hover:bg-[#E5A500] transition-all duration-300 shadow-md">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Voir profil
                                        </a>
                                        
                                        @if(Auth::id() === $post->user_id)
                                        <form method="POST" action="#" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette publication ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500 transition p-1">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>

                                <!-- DESCRIPTION -->
                                <p class="text-gray-700 dark:text-gray-300 text-sm mb-4 leading-relaxed">
                                    {{ $post->description }}
                                </p>

                                <!-- IMAGE -->
                                @if($post->image)
                                <div class="mb-4 rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/'.$post->image) }}"
                                         class="w-full max-h-96 object-cover rounded-lg cursor-pointer hover:opacity-95 transition"
                                         onclick="showImageModal('{{ asset('storage/'.$post->image) }}')">
                                </div>
                                @endif

                                <!-- LIKES ET COMMENTAIRES -->
                                <div class="flex items-center gap-5 mb-3">
                                    <button onclick="toggleComments({{ $post->id }})" 
                                            class="flex items-center gap-1.5 text-gray-500 hover:text-[#FFB703] transition text-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                        </svg>
                                        <span>{{ $post->comments->count() }} commentaire(s)</span>
                                    </button>
                                </div>

                                <!-- COMMENTAIRES -->
                                <div id="comments-{{ $post->id }}" class="hidden space-y-3 mt-3">
                                    <div class="space-y-3 max-h-40 overflow-y-auto">
                                        @forelse($post->comments as $comment)
                                        <div class="flex items-start gap-3 text-sm">
                                            <img src="https://ui-avatars.com/api/?name={{ $comment->user->name }}&background=0A2647&color=FFB703&size=28" 
                                                 class="w-7 h-7 rounded-full">
                                            <div class="flex-1">
                                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-2">
                                                    <span class="font-semibold text-gray-800 dark:text-white text-xs">{{ $comment->user->name }}</span>
                                                    <p class="text-gray-600 dark:text-gray-300 text-xs mt-0.5">{{ $comment->content }}</p>
                                                </div>
                                                <span class="text-xs text-gray-400 dark:text-gray-500 mt-1 block">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        @empty
                                        <p class="text-xs text-gray-500 dark:text-gray-400 text-center py-2">Aucun commentaire pour le moment</p>
                                        @endforelse
                                    </div>
                                    
                                    <form class="comment-form" method="POST" action="{{route('comment.create', $post)}}">
                                        @csrf
                                        <div class="flex items-start gap-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0A2647&color=FFB703&size=32" 
                                                 class="w-8 h-8 rounded-full">
                                            <div class="flex-1">
                                                <textarea name="content" 
                                                          rows="2"
                                                          placeholder="Écrire un commentaire..."
                                                          class="w-full p-2 text-sm border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none resize-none"></textarea>
                                                    
                                                          
                                                <button type="submit" 
                                                        class="mt-2 px-3 py-1 text-sm bg-[#FFB703] text-[#0A2647] rounded-lg hover:bg-[#E5A500] transition font-medium">
                                                    Commenter
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-xl transition-colors">
                            <svg class="w-20 h-20 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400">Aucune publication pour le moment</p>
                            <p class="text-sm text-gray-400 dark:text-gray-500 mt-2">Soyez le premier à publier quelque chose !</p>
                        </div>
                        @endforelse
                    </div>
                    
                    <!-- PAGINATION -->
                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- IMAGE MODAL -->
    <div id="imageModal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50" onclick="closeImageModal()">
        <img id="modalImage" class="max-w-[90%] max-h-[90%] rounded-lg shadow-2xl" src="">
    </div>

    <script>
        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const darkModeIcon = document.getElementById('darkModeIcon');
        
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
            darkModeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>';
        } else {
            darkModeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>';
        }
        
        darkModeToggle.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
                darkModeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('darkMode', 'true');
                darkModeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>';
            }
        });
        
        // Notification Functions
        function closeNotification() {
            const toast = document.getElementById('notificationToast');
            if (toast) toast.classList.add('hidden');
        }
        
        function showNotification(message, type = 'success') {
            const toast = document.getElementById('notificationToast');
            const msgSpan = document.getElementById('notificationMessage');
            msgSpan.textContent = message;
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }
        
        // Functions
        function escapeHtml(text) {
            if(!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        function viewProfessional(professionalId) {
            if(professionalId) {
                window.location.href = '/professional/' + professionalId;
            }
        }
        
        function showImageModal(imageUrl) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = imageUrl;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
        
        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }
        
        function toggleComments(postId) {
            const commentsDiv = document.getElementById('comments-' + postId);
            if (commentsDiv.classList.contains('hidden')) {
                commentsDiv.classList.remove('hidden');
            } else {
                commentsDiv.classList.add('hidden');
            }
        }
        
        
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        // Apply Filters Function
        function applyFilters() {
            let nom = document.getElementById('filterNom')?.value.trim() || '';
            let categorie = document.getElementById('filterCategorie')?.value.trim() || '';
            let specialite = document.getElementById('filterSpecialite')?.value.trim() || '';
            let ville = document.getElementById('filterVille')?.value.trim() || '';
            
            let resultsContainer = document.getElementById("professionalsResults");
            
            if(resultsContainer) {
                resultsContainer.innerHTML = '<div class="text-center py-8 text-gray-500">Recherche en cours...</div>';
            }
            
            $.ajax({
                url: "{{ route('search.professionals') }}",
                type: "GET",
                data: {
                    nom: nom,
                    categorie: categorie,
                    specialite: specialite,
                    ville: ville
                },
                success: function(professionals) {
                    if(resultsContainer) {
                        if(professionals.length === 0) {
                            resultsContainer.innerHTML = '<div class="text-center py-8 text-gray-500">Aucun professionnel trouvé.</div>';
                            return;
                        }
                        
                        resultsContainer.innerHTML = "";
                        professionals.forEach(pro => {
                            resultsContainer.innerHTML += `
                                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden border border-gray-200 dark:border-gray-700 professional-card mb-3">
                                    <div class="p-4">
                                        <div class="flex items-center justify-between mb-3">
                                            <div class="flex items-center gap-3">
                                                <img src="${pro.photo || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(pro.name) + '&background=0A2647&color=FFB703&size=40'}" 
                                                     class="w-10 h-10 rounded-full object-cover">
                                                <div>
                                                    <h3 class="font-bold text-sm text-gray-800 dark:text-white">${escapeHtml(pro.name)}</h3>
                                                    <p class="text-xs text-gray-500">${pro.category || 'Professionnel'} • ${pro.city || 'Ville inconnue'}</p>
                                                </div>
                                            </div>
                                            <button onclick="viewProfessional(${pro.id})" 
                                                    class="text-xs bg-[#FFB703] text-[#0A2647] px-3 py-1 rounded-full hover:bg-[#E5A500] transition">
                                                Voir profil
                                            </button>
                                        </div>
                                        <div class="flex flex-wrap gap-2 text-xs mb-3">
                                            ${pro.speciality ? `<span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 px-2 py-1 rounded-full">🏷️ ${escapeHtml(pro.speciality)}</span>` : ''}
                                            ${pro.city ? `<span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 px-2 py-1 rounded-full">📍 ${escapeHtml(pro.city)}</span>` : ''}
                                            ${pro.region ? `<span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 px-2 py-1 rounded-full">🗺️ ${escapeHtml(pro.region)}</span>` : ''}
                                        </div>
                                        ${pro.bio ? `<p class="text-gray-600 dark:text-gray-400 text-sm">${escapeHtml(pro.bio.substring(0, 100))}${pro.bio.length > 100 ? '...' : ''}</p>` : ''}
                                    </div>
                                </div>
                            `;
                        });
                    }
                },
                error: function(xhr) {
                    console.error('Erreur AJAX:', xhr);
                    if(resultsContainer) {
                        resultsContainer.innerHTML = '<div class="text-center py-8 text-red-500">Erreur lors de la recherche. Veuillez réessayer.</div>';
                    }
                }
            });
        }
        
        function hideResults() {
            const resultsContainer = document.getElementById("professionalsResults");
            if(resultsContainer) resultsContainer.innerHTML = '';
        }
        
        let isFilterBarVisible = false;
        
        function toggleFilterBar() {
            const filterBar = document.getElementById('filterBar');
            const filterBtn = document.getElementById('filterToggleBtn');
            const resultsContainer = document.getElementById("professionalsResults");
            
            if(filterBar && filterBtn) {
                if (filterBar.classList.contains('filter-bar-hidden')) {
                    filterBar.classList.remove('filter-bar-hidden');
                    filterBar.classList.add('filter-bar-visible');
                    filterBtn.innerHTML = `
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span>Masquer filtres</span>
                    `;
                    isFilterBarVisible = true;
                } else {
                    filterBar.classList.remove('filter-bar-visible');
                    filterBar.classList.add('filter-bar-hidden');
                    filterBtn.innerHTML = `
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        <span>Filtres</span>
                    `;
                    isFilterBarVisible = false;
                    if(resultsContainer) resultsContainer.innerHTML = '';
                }
            }
        }
        
        // File input handler
        const fileInput = document.getElementById('postImage');
        const fileNameSpan = document.getElementById('fileName');
        
        if (fileInput && fileNameSpan) {
            fileInput.addEventListener('change', function() {
                fileNameSpan.textContent = this.files[0] ? this.files[0].name : '';
            });
        }
        
        // Post Form AJAX Submission
        const postForm = document.getElementById('postForm');
        if (postForm) {
            postForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                
                $.ajax({
                    url: this.action,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            showNotification('Publication ajoutée avec succès !');
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            showNotification('Erreur: ' + response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        showNotification('Erreur lors de l\'ajout de la publication', 'error');
                    }
                });
            });
        }
 
        // Quick search
        const quickSearch = document.getElementById('quickSearch');
        if(quickSearch) {
            quickSearch.addEventListener('input', function(e) {
                const filterNom = document.getElementById('filterNom');
                if(filterNom) filterNom.value = e.target.value;
                applyFilters();
            });
        }
        
        // Close modal on ESC
        document.addEventListener('keydown', function(e) {
            if(e.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
</body>
</html>