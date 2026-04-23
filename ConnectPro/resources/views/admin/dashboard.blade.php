<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur - ConnectPro</title>
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
            scrollbar-width: none;
            -ms-overflow-style: none;
            height: calc(100vh - 180px);
        }
        .sidebar-scroll::-webkit-scrollbar {
            display: none;
        }

        /* Animation pour les cartes statistiques */
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
        }

        /* Badge status */
        .badge-active {
            background-color: #10B981;
            color: white;
        }
        .badge-banned {
            background-color: #EF4444;
            color: white;
        }
        .badge-pending {
            background-color: #F59E0B;
            color: white;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
    
    <!-- ==================== HEADER / NAVBAR ==================== -->
    <nav class="fixed top-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-lg z-50">
        <div class="flex items-center justify-between px-6 py-3">
            
            <!-- Logo cliquable - redirige vers la page d'accueil -->
            <a href="{{ url('/') }}" class="flex items-center gap-3 transition-transform hover:scale-105">
                <div class="w-10 h-10 bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="font-bold text-xl text-[#0A2647] dark:text-white">ConnectPro</h1>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Espace administrateur</p>
                </div>
            </a>

            <!-- Barre de recherche -->
            <div class="flex-1 max-w-md mx-6">
                <div class="relative">
                    <input type="text" 
                           id="searchInput"
                           placeholder="Rechercher un utilisateur, un professionnel..." 
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
                <!-- Notifications -->
                <div class="relative">
                    <button id="notifButton" class="p-1.5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-[10px] rounded-full flex items-center justify-center">3</span>
                    </button>
                </div>

                <!-- Dark Mode Toggle -->
                <button id="darkModeToggle" class="p-1.5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition">
                    <svg id="darkModeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                <!-- Profile Admin -->
                <div class="flex items-center gap-2 cursor-pointer group">
                    <img src="https://ui-avatars.com/api/?name=Admin+System&background=0A2647&color=FFB703&size=40" 
                         class="w-8 h-8 rounded-full object-cover border-2 border-[#FFB703]">
                    <div class="hidden md:block">
                        <p class="text-sm font-semibold text-gray-700 dark:text-white">Admin System</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Super Administrateur</p>
                    </div>
                </div>

                <!-- Séparateur -->
                <div class="h-6 w-px bg-gray-300 dark:bg-gray-600"></div>

                <!-- Bouton Déconnexion -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 px-4 py-1.5 bg-red-500 hover:bg-red-600 text-white rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="text-sm font-medium hidden md:inline">Déconnexion</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex pt-16">
        
        <!-- ==================== SIDEBAR GAUCHE ADMIN ==================== -->
        <aside class="fixed left-0 top-16 h-[calc(100vh-64px)] w-72 bg-white dark:bg-gray-800 shadow-2xl z-30 flex flex-col">
            
            <!-- PROFIL ADMIN -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name=Admin+System&background=0A2647&color=FFB703&size=100"
                             alt="Photo de profil"
                             class="w-16 h-16 rounded-full object-cover border-4 border-[#FFB703] shadow-lg">
                        <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="flex-1">
                        <h2 class="font-bold text-lg text-[#0A2647] dark:text-white">Admin System</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Administrateur</p>
                        <span class="inline-flex items-center gap-1 mt-1 text-xs text-[#FFB703]">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Super Admin
                        </span>
                    </div>
                </div>
            </div>

            <!-- MENU DE NAVIGATION ADMIN -->
            <div class="flex-1 sidebar-scroll">
                <nav class="p-4">
                    <div class="space-y-1">
                        <a href="#" onclick="showSection('dashboard')" class="nav-item active flex items-center gap-3 px-4 py-3 text-[#FFB703] bg-[#FFB703]/10 rounded-xl transition group">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span>Tableau de bord</span>
                        </a>
                        <a href="#" onclick="showSection('users')" class="nav-item flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                            <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <span>Utilisateurs</span>
                            <span id="usersCount" class="ml-auto bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs px-2 py-0.5 rounded-full">0</span>
                        </a>
                        <a href="#" onclick="showSection('professionals')" class="nav-item flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                            <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>Professionnels</span>
                            <span id="professionalsCount" class="ml-auto bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs px-2 py-0.5 rounded-full">0</span>
                        </a>
                        <a href="#" onclick="showSection('admins')" class="nav-item flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                            <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span>Administrateurs</span>
                            <span id="adminsCount" class="ml-auto bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs px-2 py-0.5 rounded-full">0</span>
                        </a>
                        <a href="#" onclick="showSection('posts')" class="nav-item flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                            <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <span>Publications</span>
                            <span id="postsCount" class="ml-auto bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs px-2 py-0.5 rounded-full">0</span>
                        </a>
                    </div>
                </nav>
            </div>

            <!-- PIED DE PAGE SIDEBAR -->
            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                    <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Paramètres</span>
                </a>
            </div>
        </aside>

        <!-- ==================== CONTENU PRINCIPAL ==================== -->
        <main class="flex-1 ml-72 p-6">
            
            <!-- SECTION TABLEAU DE BORD (DEFAULT) -->
            <div id="dashboardSection">
                <!-- STATISTIQUES CARDS -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    
                    <!-- Carte Utilisateurs -->
                    <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5 border-l-4 border-[#FFB703]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Utilisateurs</p>
                                <p id="statUsers" class="text-3xl font-bold text-gray-800 dark:text-white mt-2">0</p>
                            </div>
                            <div class="w-12 h-12 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center gap-2">
                            <span class="text-xs text-green-500">+12%</span>
                            <span class="text-xs text-gray-400">ce mois</span>
                        </div>
                    </div>

                    <!-- Carte Professionnels -->
                    <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5 border-l-4 border-[#FFB703]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Professionnels</p>
                                <p id="statProfessionals" class="text-3xl font-bold text-gray-800 dark:text-white mt-2">0</p>
                            </div>
                            <div class="w-12 h-12 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center gap-2">
                            <span class="text-xs text-green-500">+8%</span>
                            <span class="text-xs text-gray-400">ce mois</span>
                        </div>
                    </div>

                    <!-- Carte Administrateurs -->
                    <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5 border-l-4 border-[#FFB703]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Administrateurs</p>
                                <p id="statAdmins" class="text-3xl font-bold text-gray-800 dark:text-white mt-2">0</p>
                            </div>
                            <div class="w-12 h-12 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center gap-2">
                            <span class="text-xs text-blue-500">2 rôles</span>
                        </div>
                    </div>

                    <!-- Carte Publications -->
                    <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5 border-l-4 border-[#FFB703]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Publications</p>
                                <p id="statPosts" class="text-3xl font-bold text-gray-800 dark:text-white mt-2">0</p>
                            </div>
                            <div class="w-12 h-12 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                        </div>
                        <div class="mt-3 flex items-center gap-2">
                            <span class="text-xs text-green-500">+23%</span>
                            <span class="text-xs text-gray-400">cette semaine</span>
                        </div>
                    </div>
                </div>

                <!-- GRAPHIQUES SIMPLES / ACTIVITÉ RÉCENTE -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Activité des publications -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5">
                        <h3 class="font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Publications par type d'utilisateur
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600 dark:text-gray-400">Publications Utilisateurs</span>
                                    <span id="userPostsCount" class="font-semibold text-gray-800 dark:text-white">0</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div id="userPostsBar" class="bg-[#FFB703] h-2 rounded-full" style="width: 0%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600 dark:text-gray-400">Publications Professionnels</span>
                                    <span id="professionalPostsCount" class="font-semibold text-gray-800 dark:text-white">0</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div id="professionalPostsBar" class="bg-[#0A2647] h-2 rounded-full" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Répartition des utilisateurs -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5">
                        <h3 class="font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Répartition des comptes
                        </h3>
                        <div class="flex items-center justify-center py-4">
                            <div class="relative w-40 h-40">
                                <canvas id="userDistributionChart" width="160" height="160"></canvas>
                            </div>
                        </div>
                        <div class="flex justify-center gap-6 mt-4">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-[#FFB703]"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Utilisateurs</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-[#0A2647]"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Professionnels</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-[#10B981]"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Admins</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION UTILISATEURS -->
            <div id="usersSection" class="hidden">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <h3 class="font-semibold text-white">Gestion des utilisateurs</h3>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="filterUsers('all')" class="filter-users-btn px-3 py-1 text-xs rounded-lg bg-[#FFB703]/20 text-[#FFB703] hover:bg-[#FFB703] hover:text-[#0A2647] transition">Tous</button>
                                <button onclick="filterUsers('active')" class="filter-users-btn px-3 py-1 text-xs rounded-lg bg-gray-600/20 text-gray-400 hover:bg-green-500 hover:text-white transition">Actifs</button>
                                <button onclick="filterUsers('banned')" class="filter-users-btn px-3 py-1 text-xs rounded-lg bg-gray-600/20 text-gray-400 hover:bg-red-500 hover:text-white transition">Bannis</button>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Utilisateur</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Ville</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Publications</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="usersTableBody" class="divide-y divide-gray-200 dark:divide-gray-700">
                                <!-- Les utilisateurs seront chargés dynamiquement -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- SECTION PROFESSIONNELS -->
            <div id="professionalsSection" class="hidden">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-6 py-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <h3 class="font-semibold text-white">Gestion des professionnels</h3>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Professionnel</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Spécialité</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Publications</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="professionalsTableBody" class="divide-y divide-gray-200 dark:divide-gray-700">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- SECTION ADMINISTRATEURS -->
            <div id="adminsSection" class="hidden">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-6 py-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <h3 class="font-semibold text-white">Gestion des administrateurs</h3>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Administrateur</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Rôle</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="adminsTableBody" class="divide-y divide-gray-200 dark:divide-gray-700">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- SECTION PUBLICATIONS -->
            <div id="postsSection" class="hidden">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-6 py-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <h3 class="font-semibold text-white">Toutes les publications</h3>
                        </div>
                    </div>
                    <div id="postsList" class="divide-y divide-gray-200 dark:divide-gray-700 max-h-[600px] overflow-y-auto custom-scrollbar">
                        <!-- Les publications seront chargées dynamiquement -->
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- MODAL DE CONFIRMATION BAN/UNBAN -->
    <div id="confirmModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-6 max-w-md w-full mx-4 transform transition-all">
            <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center" id="modalIcon">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h3 id="modalTitle" class="text-lg font-bold text-gray-800 dark:text-white mb-2">Confirmation</h3>
                <p id="modalMessage" class="text-gray-600 dark:text-gray-400 mb-6">Êtes-vous sûr de vouloir effectuer cette action ?</p>
                <div class="flex gap-3">
                    <button onclick="closeModal()" class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">Annuler</button>
                    <button id="modalConfirmBtn" class="flex-1 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl transition">Confirmer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- NOTIFICATION TOAST -->
    <div id="notificationToast" class="fixed bottom-4 right-4 z-50 hidden transform transition-all duration-300">
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

    <script>
        // ==================== DONNÉES SIMULÉES ====================
        let users = [
            { id: 1, name: "Sophie Martin", email: "sophie.martin@email.com", city: "Casablanca", status: "active", posts: 3, type: "user", avatar: "SM" },
            { id: 2, name: "Thomas Dubois", email: "thomas.dubois@email.com", city: "Rabat", status: "active", posts: 7, type: "user", avatar: "TD" },
            { id: 3, name: "Julie Bernard", email: "julie.bernard@email.com", city: "Marrakech", status: "banned", posts: 1, type: "user", avatar: "JB" },
            { id: 4, name: "Nicolas Petit", email: "nicolas.petit@email.com", city: "Fès", status: "active", posts: 5, type: "user", avatar: "NP" },
            { id: 5, name: "Camille Robert", email: "camille.robert@email.com", city: "Tanger", status: "active", posts: 2, type: "user", avatar: "CR" }
        ];

        let professionals = [
            { id: 1, name: "Dr. Jean Dupont", specialty: "Cardiologie", email: "jean.dupont@email.com", status: "active", posts: 12, type: "professional", avatar: "JD", category: "sante" },
            { id: 2, name: "Me. Marie Laurent", specialty: "Droit des affaires", email: "marie.laurent@email.com", status: "active", posts: 8, type: "professional", avatar: "ML", category: "droit" },
            { id: 3, name: "Sophie Legrand", specialty: "Développement web", email: "sophie.legrand@email.com", status: "banned", posts: 4, type: "professional", avatar: "SL", category: "informatique" },
            { id: 4, name: "Pierre Moreau", specialty: "Marketing digital", email: "pierre.moreau@email.com", status: "active", posts: 15, type: "professional", avatar: "PM", category: "marketing" },
            { id: 5, name: "Isabelle Rousseau", specialty: "Comptabilité", email: "isabelle.rousseau@email.com", status: "active", posts: 6, type: "professional", avatar: "IR", category: "finance" }
        ];

        let admins = [
            { id: 1, name: "Admin System", email: "admin@connectpro.com", role: "Super Admin", status: "active" },
            { id: 2, name: "Moderator One", email: "moderator1@connectpro.com", role: "Moderator", status: "active" },
            { id: 3, name: "Moderator Two", email: "moderator2@connectpro.com", role: "Moderator", status: "active" }
        ];

        let posts = [
            { id: 1, authorId: 1, authorName: "Dr. Jean Dupont", authorType: "professional", content: "Nouveau service de téléconsultation disponible ! Prenez rendez-vous en ligne facilement.", image: null, date: "2024-01-15", likes: 24, comments: 8 },
            { id: 2, authorId: 2, authorName: "Me. Marie Laurent", authorType: "professional", content: "Consultation juridique gratuite cette semaine pour les nouveaux clients.", image: null, date: "2024-01-14", likes: 56, comments: 15 },
            { id: 3, authorId: 1, authorName: "Sophie Martin", authorType: "user", content: "Je recherche un bon cardiologue à Casablanca, des recommandations ?", image: null, date: "2024-01-13", likes: 12, comments: 5 },
            { id: 4, authorId: 4, authorName: "Pierre Moreau", authorType: "professional", content: "Offre spéciale : Audit marketing gratuit pour les 10 premiers clients !", image: null, date: "2024-01-12", likes: 34, comments: 7 }
        ];

        // État du filtre utilisateur
        let currentUserFilter = 'all';
        let pendingAction = null;

        // ==================== FONCTIONS DE MISE À JOUR DES STATS ====================
        function updateStats() {
            const activeUsers = users.filter(u => u.status === 'active').length;
            const bannedUsers = users.filter(u => u.status === 'banned').length;
            const activeProfessionals = professionals.filter(p => p.status === 'active').length;
            const bannedProfessionals = professionals.filter(p => p.status === 'banned').length;
            const activeAdmins = admins.filter(a => a.status === 'active').length;

            // Statistiques principales
            document.getElementById('statUsers').innerText = users.length;
            document.getElementById('statProfessionals').innerText = professionals.length;
            document.getElementById('statAdmins').innerText = admins.length;
            document.getElementById('statPosts').innerText = posts.length;

            // Mise à jour des compteurs dans le menu
            document.getElementById('usersCount').innerText = users.length;
            document.getElementById('professionalsCount').innerText = professionals.length;
            document.getElementById('adminsCount').innerText = admins.length;
            document.getElementById('postsCount').innerText = posts.length;

            // Publications par type
            const userPosts = posts.filter(p => p.authorType === 'user').length;
            const professionalPosts = posts.filter(p => p.authorType === 'professional').length;
            document.getElementById('userPostsCount').innerText = userPosts;
            document.getElementById('professionalPostsCount').innerText = professionalPosts;

            const totalPosts = userPosts + professionalPosts;
            const userPercent = totalPosts > 0 ? (userPosts / totalPosts) * 100 : 0;
            const professionalPercent = totalPosts > 0 ? (professionalPosts / totalPosts) * 100 : 0;
            document.getElementById('userPostsBar').style.width = userPercent + '%';
            document.getElementById('professionalPostsBar').style.width = professionalPercent + '%';

            // Mise à jour du graphique
            updateChart();
        }

        // Graphique simple avec canvas
        function updateChart() {
            const canvas = document.getElementById('userDistributionChart');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            const total = users.length + professionals.length + admins.length;
            const usersPercent = (users.length / total) * 360;
            const prosPercent = (professionals.length / total) * 360;
            const adminsPercent = (admins.length / total) * 360;

            ctx.clearRect(0, 0, 160, 160);
            
            let start = 0;
            // Utilisateurs
            ctx.beginPath();
            ctx.fillStyle = '#FFB703';
            ctx.moveTo(80, 80);
            ctx.arc(80, 80, 70, start * Math.PI / 180, (start + usersPercent) * Math.PI / 180);
            ctx.fill();
            start += usersPercent;
            
            // Professionnels
            ctx.beginPath();
            ctx.fillStyle = '#0A2647';
            ctx.moveTo(80, 80);
            ctx.arc(80, 80, 70, start * Math.PI / 180, (start + prosPercent) * Math.PI / 180);
            ctx.fill();
            start += prosPercent;
            
            // Admins
            ctx.beginPath();
            ctx.fillStyle = '#10B981';
            ctx.moveTo(80, 80);
            ctx.arc(80, 80, 70, start * Math.PI / 180, (start + adminsPercent) * Math.PI / 180);
            ctx.fill();
        }

        // ==================== AFFICHAGE DES TABLEAUX ====================
        function renderUsersTable() {
            const tbody = document.getElementById('usersTableBody');
            let filteredUsers = users;
            if (currentUserFilter === 'active') {
                filteredUsers = users.filter(u => u.status === 'active');
            } else if (currentUserFilter === 'banned') {
                filteredUsers = users.filter(u => u.status === 'banned');
            }
            
            tbody.innerHTML = filteredUsers.map(user => `
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=${user.name}&background=0A2647&color=FFB703&size=40" class="w-10 h-10 rounded-full object-cover">
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">${user.name}</p>
                                <p class="text-xs text-gray-500">ID: #${user.id}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${user.email}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${user.city}</td>
                    <td class="px-6 py-4">
                        <span class="badge-${user.status} px-2 py-1 rounded-full text-xs font-medium ${user.status === 'active' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'}">
                            ${user.status === 'active' ? 'Actif' : 'Banni'}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${user.posts} publication(s)</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            ${user.status === 'active' ? `
                                <button onclick="openBanModal('user', ${user.id})" class="p-1.5 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-lg hover:bg-red-200 transition" title="Bannir">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                    </svg>
                                </button>
                            ` : `
                                <button onclick="openUnbanModal('user', ${user.id})" class="p-1.5 bg-green-100 dark:bg-green-900/30 text-green-600 rounded-lg hover:bg-green-200 transition" title="Réactiver">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                            `}
                            <button onclick="viewUserPosts(${user.id})" class="p-1.5 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-lg hover:bg-blue-200 transition" title="Voir publications">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function renderProfessionalsTable() {
            const tbody = document.getElementById('professionalsTableBody');
            tbody.innerHTML = professionals.map(pro => `
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=${pro.name}&background=0A2647&color=FFB703&size=40" class="w-10 h-10 rounded-full object-cover">
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">${pro.name}</p>
                                <p class="text-xs text-gray-500">${pro.specialty}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${pro.specialty}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${pro.email}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium ${pro.status === 'active' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'}">
                            ${pro.status === 'active' ? 'Actif' : 'Banni'}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${pro.posts} publication(s)</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            ${pro.status === 'active' ? `
                                <button onclick="openBanModal('professional', ${pro.id})" class="p-1.5 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-lg hover:bg-red-200 transition" title="Bannir">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                    </svg>
                                </button>
                            ` : `
                                <button onclick="openUnbanModal('professional', ${pro.id})" class="p-1.5 bg-green-100 dark:bg-green-900/30 text-green-600 rounded-lg hover:bg-green-200 transition" title="Réactiver">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                            `}
                            <button onclick="viewProfessionalPosts(${pro.id})" class="p-1.5 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-lg hover:bg-blue-200 transition" title="Voir publications">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function renderAdminsTable() {
            const tbody = document.getElementById('adminsTableBody');
            tbody.innerHTML = admins.map(admin => `
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=${admin.name}&background=0A2647&color=FFB703&size=40" class="w-10 h-10 rounded-full object-cover">
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">${admin.name}</p>
                                <p class="text-xs text-gray-500">ID: #${admin.id}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${admin.email}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${admin.role}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                            Actif
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <button class="p-1.5 bg-gray-100 dark:bg-gray-700 text-gray-600 rounded-lg cursor-not-allowed" disabled title="Action non disponible">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function renderPosts() {
            const container = document.getElementById('postsList');
            container.innerHTML = posts.map(post => {
                const author = [...users, ...professionals].find(u => u.id === post.authorId && u.type === post.authorType);
                const authorName = author ? author.name : post.authorName;
                return `
                    <div class="p-5 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name=${authorName}&background=0A2647&color=FFB703&size=40" class="w-10 h-10 rounded-full object-cover">
                                <div>
                                    <h4 class="font-semibold text-gray-800 dark:text-white">${authorName}</h4>
                                    <p class="text-xs text-gray-500">${post.authorType === 'professional' ? 'Professionnel' : 'Utilisateur'} • ${post.date}</p>
                                </div>
                            </div>
                            <button onclick="deletePost(${post.id})" class="p-1.5 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-lg hover:bg-red-200 transition" title="Supprimer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 mb-3">${post.content}</p>
                        <div class="flex gap-4 text-sm">
                            <span class="flex items-center gap-1 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                ${post.likes} likes
                            </span>
                            <span class="flex items-center gap-1 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                ${post.comments} commentaires
                            </span>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // ==================== ACTIONS BAN / UNBAN ====================
        function openBanModal(type, id) {
            const item = type === 'user' ? users.find(u => u.id === id) : professionals.find(p => p.id === id);
            if (!item) return;
            
            pendingAction = { type, action: 'ban', id };
            document.getElementById('modalIcon').innerHTML = `<svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>`;
            document.getElementById('modalTitle').innerText = 'Bannir le compte';
            document.getElementById('modalMessage').innerHTML = `Êtes-vous sûr de vouloir bannir <strong>${item.name}</strong> ?<br>Cette action désactivera son compte et masquera ses publications.`;
            document.getElementById('modalConfirmBtn').onclick = () => confirmAction();
            document.getElementById('confirmModal').classList.remove('hidden');
            document.getElementById('confirmModal').classList.add('flex');
        }

        function openUnbanModal(type, id) {
            const item = type === 'user' ? users.find(u => u.id === id) : professionals.find(p => p.id === id);
            if (!item) return;
            
            pendingAction = { type, action: 'unban', id };
            document.getElementById('modalIcon').innerHTML = `<svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>`;
            document.getElementById('modalTitle').innerText = 'Réactiver le compte';
            document.getElementById('modalMessage').innerHTML = `Êtes-vous sûr de vouloir réactiver <strong>${item.name}</strong> ?<br>Cette action rétablira son compte et ses publications.`;
            document.getElementById('modalConfirmBtn').onclick = () => confirmAction();
            document.getElementById('confirmModal').classList.remove('hidden');
            document.getElementById('confirmModal').classList.add('flex');
        }

        function confirmAction() {
            if (!pendingAction) return;
            
            const { type, action, id } = pendingAction;
            
            if (type === 'user') {
                const userIndex = users.findIndex(u => u.id === id);
                if (userIndex !== -1) {
                    users[userIndex].status = action === 'ban' ? 'banned' : 'active';
                    showNotification(`Utilisateur ${users[userIndex].name} ${action === 'ban' ? 'banni' : 'réactivé'} avec succès`, 'success');
                }
                renderUsersTable();
            } else if (type === 'professional') {
                const proIndex = professionals.findIndex(p => p.id === id);
                if (proIndex !== -1) {
                    professionals[proIndex].status = action === 'ban' ? 'banned' : 'active';
                    showNotification(`Professionnel ${professionals[proIndex].name} ${action === 'ban' ? 'banni' : 'réactivé'} avec succès`, 'success');
                }
                renderProfessionalsTable();
            }
            
            updateStats();
            closeModal();
            pendingAction = null;
        }

        function deletePost(postId) {
            const postIndex = posts.findIndex(p => p.id === postId);
            if (postIndex !== -1) {
                const post = posts[postIndex];
                posts.splice(postIndex, 1);
                showNotification(`Publication de ${post.authorName} supprimée avec succès`, 'success');
                renderPosts();
                updateStats();
            }
        }

        function viewUserPosts(userId) {
            const user = users.find(u => u.id === userId);
            const userPosts = posts.filter(p => p.authorId === userId && p.authorType === 'user');
            showNotification(`${user.name} a publié ${userPosts.length} publication(s)`, 'info');
        }

        function viewProfessionalPosts(proId) {
            const pro = professionals.find(p => p.id === proId);
            const proPosts = posts.filter(p => p.authorId === proId && p.authorType === 'professional');
            showNotification(`${pro.name} a publié ${proPosts.length} publication(s)`, 'info');
        }

        function filterUsers(filter) {
            currentUserFilter = filter;
            renderUsersTable();
            document.querySelectorAll('.filter-users-btn').forEach(btn => {
                btn.classList.remove('bg-[#FFB703]', 'text-[#0A2647]');
                btn.classList.add('bg-gray-600/20', 'text-gray-400');
            });
            if (filter === 'all') {
                document.querySelector('.filter-users-btn:first-child').classList.remove('bg-gray-600/20', 'text-gray-400');
                document.querySelector('.filter-users-btn:first-child').classList.add('bg-[#FFB703]', 'text-[#0A2647]');
            } else if (filter === 'active') {
                document.querySelector('.filter-users-btn:nth-child(2)').classList.remove('bg-gray-600/20', 'text-gray-400');
                document.querySelector('.filter-users-btn:nth-child(2)').classList.add('bg-green-500', 'text-white');
            } else if (filter === 'banned') {
                document.querySelector('.filter-users-btn:nth-child(3)').classList.remove('bg-gray-600/20', 'text-gray-400');
                document.querySelector('.filter-users-btn:nth-child(3)').classList.add('bg-red-500', 'text-white');
            }
        }

        function showNotification(message, type = 'success') {
            const toast = document.getElementById('notificationToast');
            const messageEl = document.getElementById('notificationMessage');
            messageEl.innerText = message;
            toast.classList.remove('hidden');
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }

        function closeModal() {
            document.getElementById('confirmModal').classList.add('hidden');
            document.getElementById('confirmModal').classList.remove('flex');
        }

        function closeNotification() {
            document.getElementById('notificationToast').classList.add('hidden');
        }

        // ==================== NAVIGATION ENTRE SECTIONS ====================
        function showSection(section) {
            document.getElementById('dashboardSection').classList.add('hidden');
            document.getElementById('usersSection').classList.add('hidden');
            document.getElementById('professionalsSection').classList.add('hidden');
            document.getElementById('adminsSection').classList.add('hidden');
            document.getElementById('postsSection').classList.add('hidden');
            
            if (section === 'dashboard') document.getElementById('dashboardSection').classList.remove('hidden');
            else if (section === 'users') document.getElementById('usersSection').classList.remove('hidden');
            else if (section === 'professionals') document.getElementById('professionalsSection').classList.remove('hidden');
            else if (section === 'admins') document.getElementById('adminsSection').classList.remove('hidden');
            else if (section === 'posts') document.getElementById('postsSection').classList.remove('hidden');
            
            // Mise à jour du style des liens
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('text-[#FFB703]', 'bg-[#FFB703]/10');
                item.classList.add('text-gray-700', 'dark:text-gray-300');
                item.querySelector('svg')?.classList.remove('text-[#FFB703]');
                item.querySelector('svg')?.classList.add('group-hover:text-[#FFB703]');
            });
            const activeLink = document.querySelector(`.nav-item[onclick="showSection('${section}')"]`);
            if (activeLink) {
                activeLink.classList.remove('text-gray-700', 'dark:text-gray-300');
                activeLink.classList.add('text-[#FFB703]', 'bg-[#FFB703]/10');
                activeLink.querySelector('svg')?.classList.add('text-[#FFB703]');
            }
        }

        // ==================== RECHERCHE ====================
        function setupSearch() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    const query = e.target.value.toLowerCase();
                    if (document.getElementById('usersSection') && !document.getElementById('usersSection').classList.contains('hidden')) {
                        const filtered = users.filter(u => u.name.toLowerCase().includes(query) || u.email.toLowerCase().includes(query));
                        const tbody = document.getElementById('usersTableBody');
                        tbody.innerHTML = filtered.map(user => `...`).join('');
                        renderUsersTableFiltered(filtered);
                    } else if (document.getElementById('professionalsSection') && !document.getElementById('professionalsSection').classList.contains('hidden')) {
                        const filtered = professionals.filter(p => p.name.toLowerCase().includes(query) || p.email.toLowerCase().includes(query) || p.specialty.toLowerCase().includes(query));
                        renderProfessionalsTableFiltered(filtered);
                    }
                });
            }
        }

        function renderUsersTableFiltered(filteredUsers) {
            const tbody = document.getElementById('usersTableBody');
            tbody.innerHTML = filteredUsers.map(user => `
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=${user.name}&background=0A2647&color=FFB703&size=40" class="w-10 h-10 rounded-full object-cover">
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">${user.name}</p>
                                <p class="text-xs text-gray-500">ID: #${user.id}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${user.email}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${user.city}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium ${user.status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}">
                            ${user.status === 'active' ? 'Actif' : 'Banni'}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${user.posts} publication(s)</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            ${user.status === 'active' ? `
                                <button onclick="openBanModal('user', ${user.id})" class="p-1.5 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition" title="Bannir">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                    </svg>
                                </button>
                            ` : `
                                <button onclick="openUnbanModal('user', ${user.id})" class="p-1.5 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition" title="Réactiver">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                            `}
                            <button onclick="viewUserPosts(${user.id})" class="p-1.5 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition" title="Voir publications">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function renderProfessionalsTableFiltered(filteredPros) {
            const tbody = document.getElementById('professionalsTableBody');
            tbody.innerHTML = filteredPros.map(pro => `
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=${pro.name}&background=0A2647&color=FFB703&size=40" class="w-10 h-10 rounded-full object-cover">
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">${pro.name}</p>
                                <p class="text-xs text-gray-500">${pro.specialty}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${pro.specialty}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${pro.email}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium ${pro.status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}">
                            ${pro.status === 'active' ? 'Actif' : 'Banni'}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${pro.posts} publication(s)</td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            ${pro.status === 'active' ? `
                                <button onclick="openBanModal('professional', ${pro.id})" class="p-1.5 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition" title="Bannir">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                    </svg>
                                </button>
                            ` : `
                                <button onclick="openUnbanModal('professional', ${pro.id})" class="p-1.5 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition" title="Réactiver">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                            `}
                            <button onclick="viewProfessionalPosts(${pro.id})" class="p-1.5 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition" title="Voir publications">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        // ==================== DARK MODE ====================
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

        // ==================== INITIALISATION ====================
        function init() {
            updateStats();
            renderUsersTable();
            renderProfessionalsTable();
            renderAdminsTable();
            renderPosts();
            setupSearch();
            showSection('dashboard');
        }

        init();
    </script>

</body>
</html>