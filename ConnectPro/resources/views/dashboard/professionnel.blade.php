<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Professionnel - ConnectPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        
        /* Hide scrollbar for sidebar but keep functionality */
        .sidebar-scroll {
            overflow-y: auto;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }
        .sidebar-scroll::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }

        /* Dark mode transition */
        * {
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
    
    <!-- ==================== HEADER / NAVBAR ==================== -->
    <nav class="fixed top-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-lg z-50">
        <div class="flex items-center justify-between px-6 py-3">
            
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="font-bold text-xl text-[#0A2647] dark:text-white">ConnectPro</h1>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Espace professionnel</p>
                </div>
            </div>

            <!-- Barre de recherche -->
            <div class="flex-1 max-w-md mx-6">
                <div class="relative">
                    <input type="text" 
                           placeholder="Rechercher un professionnel, un service..." 
                           class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition text-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Navigation links -->
            <div class="flex items-center gap-6">
                <!-- Dark Mode Toggle -->
                <button id="darkModeToggle" class="p-1.5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition">
                    <svg id="darkModeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                <!-- Profile -->
                <a href="{{route('profile.profile')}}" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:text-[#FFB703] transition group">
                    <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-sm font-medium">Profile</span>
                </a>
                
                <!-- Contact -->
                <a href="#" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:text-[#FFB703] transition group">
                    <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm font-medium">Contact</span>
                </a>

                <!-- Séparateur -->
                <div class="h-6 w-px bg-gray-300 dark:bg-gray-600"></div>

                <!-- Notifications -->
                <button onclick="toggleNotifications()" class="relative p-1.5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                <!-- Messages -->
                <button onclick="toggleMessages()" class="relative p-1.5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-[#FFB703] rounded-full"></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- NOTIFICATIONS FLOTTANTES -->
    <div id="notificationToast" class="fixed top-20 right-4 z-50 hidden transform transition-all duration-300">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-4 max-w-sm border-l-4 border-[#FFB703]">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-[#FFB703]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V5h2v4z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-800 dark:text-white">Nouvelle notification</h4>
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

    <!-- Dropdown notifications globales -->
    <div id="notificationsDropdownGlobal" class="fixed top-14 right-24 mt-2 w-80 bg-white dark:bg-gray-800 rounded-xl shadow-2xl hidden z-50">
        <div class="p-3 border-b border-gray-200 dark:border-gray-700">
            <h3 class="font-semibold text-gray-800 dark:text-white">Notifications</h3>
        </div>
        <div class="max-h-96 overflow-y-auto">
            <div class="p-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition cursor-pointer">
                <p class="text-sm text-gray-700 dark:text-gray-300">Nouvelle demande de consultation</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Il y a 5 minutes</p>
            </div>
            <div class="p-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition cursor-pointer">
                <p class="text-sm text-gray-700 dark:text-gray-300">Votre publication a reçu un like</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">Il y a 1 heure</p>
            </div>
        </div>
    </div>

    <div id="messagesDropdownGlobal" class="fixed top-14 right-4 mt-2 w-80 bg-white dark:bg-gray-800 rounded-xl shadow-2xl hidden z-50">
        <div class="p-3 border-b border-gray-200 dark:border-gray-700">
            <h3 class="font-semibold text-gray-800 dark:text-white">Messages</h3>
        </div>
        <div class="max-h-96 overflow-y-auto">
            <div class="p-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition cursor-pointer">
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=Client+Martin&background=FFB703&color=0A2647&size=40" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="text-sm font-semibold text-gray-800 dark:text-white">Client Martin</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Bonjour, je suis intéressé...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex pt-16">
        
        <!-- ==================== SIDEBAR GAUCHE (SCROLLABLE HIDDEN) ==================== -->
        <aside class="fixed left-0 top-16 h-full w-72 bg-white dark:bg-gray-800 shadow-2xl z-30 transform transition-transform duration-300 flex flex-col">

            <!-- SCROLLABLE CONTENT (Hidden scrollbar) -->
            <div class="flex-1 sidebar-scroll">
                
                <!-- PROFIL UTILISATEUR - DESIGN HORIZONTAL -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-4">
                        <!-- Photo de profil -->
                        <div class="relative">
                            <img src="https://ui-avatars.com/api/?name=Jean+Dupont&background=0A2647&color=FFB703&size=100"
                                 alt="Photo de profil"
                                 class="w-16 h-16 rounded-full object-cover border-4 border-[#FFB703] shadow-lg">
                            <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                        </div>
                        
                        <!-- Infos profil à côté de la photo -->
                        <div class="flex-1">
                            <h2 class="font-bold text-lg text-[#0A2647] dark:text-white">Jean Dupont</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Professionnel</p>
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-1 mt-1 text-xs text-[#FFB703] hover:text-[#E5A500] transition">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                Modifier
                            </a>
                        </div>
                    </div>
                </div>

                <!-- MENU DE NAVIGATION -->
                <nav class="p-4">
                    <div class="space-y-1">
                        <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                            <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span>Mes publications</span>
                            <span class="ml-auto bg-[#FFB703] text-[#0A2647] text-xs px-2 py-0.5 rounded-full">12</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                            <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span>Demandes de consultation</span>
                        </a>
                    </div>
                </nav>
            </div>

            <!-- PIED DE PAGE SIDEBAR (Paramètres + Déconnexion) - FIXED -->
            <div class="p-4 border-t border-gray-200 dark:border-gray-700 flex-shrink-0">
                <div class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                        <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Paramètres</span>
                    </a>
                    <form method="POST" action="#" class="w-full">
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 dark:text-red-400 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 transition group">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Déconnexion</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- ==================== CONTENU PRINCIPAL ==================== -->
        <main class="flex-1 ml-72 p-6">
            
            <!-- SECTION CRÉATION DE PUBLICATION -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg mb-6 overflow-hidden">
                <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-4 py-2.5">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <h2 class="text-md font-semibold text-white">Créer une publication</h2>
                    </div>
                </div>
                <div class="p-3">
                    <form id="postForm" method="POST" action="#" enctype="multipart/form-data">
                        <textarea name="content" id="postContent" rows="2"
                                  placeholder="Partagez une idée, un service, une actualité..."
                                  class="w-full p-2.5 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition resize-none text-sm"></textarea>
                        <div class="flex flex-wrap items-center justify-between gap-2 mt-2">
                            <div class="flex items-center gap-2">
                                <label for="postImage" class="cursor-pointer px-2.5 py-1 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center gap-1.5 text-xs text-gray-700 dark:text-gray-300">
                                    <svg class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>Image</span>
                                </label>
                                <input type="file" name="image" id="postImage" accept="image/*" class="hidden">
                                <span id="fileName" class="text-xs text-gray-500 dark:text-gray-400"></span>
                            </div>
                            <button type="submit"
                                    class="px-4 py-1 bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] hover:from-[#1E4A6D] hover:to-[#2C7DA0] text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md flex items-center gap-1.5 text-xs">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Publier
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SECTION FLUX DES PUBLICATIONS -->
            <div>
                <h2 class="text-md font-bold text-[#0A2647] dark:text-white mb-3">Flux d'actualités</h2>
                
                <div id="postsFeed" class="space-y-4 max-h-[calc(100vh-200px)] overflow-y-auto pr-2 custom-scrollbar">
                    
                    <!-- EXEMPLE DE PUBLICATION 1 -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2.5">
                                    <img src="https://ui-avatars.com/api/?name=Dr+Thomas&background=0A2647&color=FFB703&size=40" 
                                         class="w-10 h-10 rounded-full object-cover">
                                    <div>
                                        <h3 class="font-bold text-sm text-gray-800 dark:text-white">Dr. Thomas Bernard</h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Cardiologue • 2 heures</p>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300 mb-3 text-sm">
                                Nouveau service de téléconsultation disponible ! Prenez rendez-vous en ligne facilement.
                            </p>
                            <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=600&h=400&fit=crop" 
                                 class="w-full h-48 object-cover rounded-lg mb-3">
                            <div class="flex items-center gap-5">
                                <button class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400 hover:text-red-500 transition text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    <span>24 likes</span>
                                </button>
                                <button class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400 hover:text-[#FFB703] transition text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <span>8 commentaires</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- EXEMPLE DE PUBLICATION 2 -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2.5">
                                    <img src="https://ui-avatars.com/api/?name=Marie+Martin&background=0A2647&color=FFB703&size=40" 
                                         class="w-10 h-10 rounded-full object-cover">
                                    <div>
                                        <h3 class="font-bold text-sm text-gray-800 dark:text-white">Marie Martin</h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Avocate • 5 heures</p>
                                    </div>
                                </div>
                                <button class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300 mb-3 text-sm">
                                Consultation juridique gratuite cette semaine pour les nouveaux clients. Contactez-moi pour plus d'informations !
                            </p>
                            <div class="flex items-center gap-5">
                                <button class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400 hover:text-red-500 transition text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    <span>56 likes</span>
                                </button>
                                <button class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400 hover:text-[#FFB703] transition text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <span>15 commentaires</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const darkModeIcon = document.getElementById('darkModeIcon');
        
        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
            darkModeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 