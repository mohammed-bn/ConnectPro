<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Administrateur - ConnectPro</title>
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
        
        .sidebar-scroll {
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            height: calc(100vh - 180px);
        }
        .sidebar-scroll::-webkit-scrollbar {
            display: none;
        }

        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
        }
        
        .tab-active {
            background-color: #FFB703;
            color: #0A2647;
        }
        .tab-inactive {
            background-color: #374151;
            color: #9CA3AF;
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
    <nav class="fixed top-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-lg z-50">
        <div class="flex items-center justify-between px-6 py-3">
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

            <div class="flex-1 max-w-md mx-6">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Rechercher un utilisateur..." class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition text-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-6">
                <button id="darkModeToggle" class="p-1.5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition">
                    <svg id="darkModeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                </button>

                <div class="flex items-center gap-2 cursor-pointer group">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=0A2647&color=FFB703&size=40" class="w-8 h-8 rounded-full object-cover border-2 border-[#FFB703]">
                    <div class="hidden md:block">
                        <p class="text-sm font-semibold text-gray-700 dark:text-white">{{ Auth::user()->name ?? 'Admin System' }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Super Administrateur</p>
                    </div>
                </div>

                <div class="h-6 w-px bg-gray-300 dark:bg-gray-600"></div>

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

    <!-- SEARCH RESULTS -->
                <div id="professionalsResults" class="mb-6 space-y-3 max-h-[400px] overflow-y-auto custom-scrollbar pr-2">
    </div>

    <div class="flex pt-16">
        <!-- SIDEBAR -->
        <aside class="fixed left-0 top-16 h-[calc(100vh-64px)] w-72 bg-white dark:bg-gray-800 shadow-2xl z-30 flex-col hidden md:flex">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=0A2647&color=FFB703&size=100" class="w-16 h-16 rounded-full object-cover border-4 border-[#FFB703] shadow-lg">
                        <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="flex-1">
                        <h2 class="font-bold text-lg text-[#0A2647] dark:text-white">{{ Auth::user()->name ?? 'Admin System' }}</h2>
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
                            <span class="ml-auto bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs px-2 py-0.5 rounded-full">{{ $totalUsers }}</span>
                        </a>
                        <a href="#" onclick="showSection('professionals')" class="nav-item flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                            <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>Professionnels</span>
                            <span class="ml-auto bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs px-2 py-0.5 rounded-full">{{ $totalProfessionnels }}</span>
                        </a>
                        <a href="#" onclick="showSection('clients')" class="nav-item flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                            <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Clients</span>
                            <span class="ml-auto bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs px-2 py-0.5 rounded-full">{{ $totalClients }}</span>
                        </a>
                        <a href="#" onclick="showSection('admins')" class="nav-item flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                            <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span>Administrateurs</span>
                            <span class="ml-auto bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs px-2 py-0.5 rounded-full">{{ $totalAdmins }}</span>
                        </a>
                    </div>
                </nav>
            </div>

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

        <!-- MAIN CONTENT -->
        <main class="flex-1 md:ml-72 p-6">
            
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

            <!-- SECTION TABLEAU DE BORD -->
            <div id="dashboardSection">
                <!-- STATISTIQUES CARDS -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5 border-l-4 border-[#FFB703]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Utilisateurs</p>
                                <p class="text-3xl font-bold text-gray-800 dark:text-white mt-2">{{ $totalUsers }}</p>
                            </div>
                            <div class="w-12 h-12 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5 border-l-4 border-[#FFB703]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Professionnels</p>
                                <p class="text-3xl font-bold text-gray-800 dark:text-white mt-2">{{ $totalProfessionnels }}</p>
                            </div>
                            <div class="w-12 h-12 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5 border-l-4 border-[#FFB703]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Clients</p>
                                <p class="text-3xl font-bold text-gray-800 dark:text-white mt-2">{{ $totalClients }}</p>
                            </div>
                            <div class="w-12 h-12 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="stat-card bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5 border-l-4 border-[#FFB703]">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Administrateurs</p>
                                <p class="text-3xl font-bold text-gray-800 dark:text-white mt-2">{{ $totalAdmins }}</p>
                            </div>
                            <div class="w-12 h-12 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- GRAPHIQUES -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Publications par type d'utilisateur -->
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
                                    <span class="text-gray-600 dark:text-gray-400">👨‍💼 Professionnels</span>
                                    <span class="font-semibold text-gray-800 dark:text-white">{{ $totalePostProfessionnel }} posts ({{ $postPercentages['professionnel'] }}%)</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                    <div class="bg-[#0A2647] h-2.5 rounded-full" style="width: {{ $postPercentages['professionnel'] }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600 dark:text-gray-400">👤 Clients</span>
                                    <span class="font-semibold text-gray-800 dark:text-white">{{ $totalePostClient }} posts ({{ $postPercentages['client'] }}%)</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                    <div class="bg-[#FFB703] h-2.5 rounded-full" style="width: {{ $postPercentages['client'] }}%"></div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="border-t border-gray-200 dark:border-gray-700 my-4"></div>
                        
                        <h4 class="font-semibold text-gray-800 dark:text-white mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            Commentaires par type d'utilisateur
                        </h4>
                        
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600 dark:text-gray-400">👨‍💼 Professionnels</span>
                                    <span class="font-semibold text-gray-800 dark:text-white">{{ $commentsProfessionnel }} commentaires</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $commentPercentages['professionnel'] }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600 dark:text-gray-400">👤 Clients</span>
                                    <span class="font-semibold text-gray-800 dark:text-white">{{ $commentsClient }} commentaires</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div class="bg-purple-500 h-2 rounded-full" style="width: {{ $commentPercentages['client'] }}%"></div>
                                </div>
                            </div>
                            <div>

                            </div>
                        </div>
                        
                        <div class="mt-4 pt-3 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between">
                                <span class="font-semibold text-gray-700 dark:text-gray-300">📊 Total publications</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ $totalePost }}</span>
                            </div>
                            <div class="flex justify-between mt-1">
                                <span class="font-semibold text-gray-700 dark:text-gray-300">💬 Total commentaires</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ $totalComments }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Répartition des comptes -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-5">
                        <h3 class="font-semibold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Répartition des comptes
                        </h3>
                        
                        <div class="flex flex-col items-center">
                            <div class="relative w-48 h-48 mb-4">
                                <canvas id="accountsChart" width="192" height="192"></canvas>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-2xl font-bold text-[#0A2647] dark:text-white">{{ $accountDistribution['total'] }}</span>
                                </div>
                            </div>
                            
                            <div class="flex flex-wrap justify-center gap-4 mt-2">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full bg-[#FFB703]"></div>
                                    <span class="text-xs text-gray-600 dark:text-gray-400">Clients: <strong>{{ $totalClients }}</strong> ({{ $accountPercentages['clients'] }}%)</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full bg-[#F97316]"></div>
                                    <span class="text-xs text-gray-600 dark:text-gray-400">Professionnels: <strong>{{ $totalProfessionnels }}</strong> ({{ $accountPercentages['professionnels'] }}%)</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full bg-[#10B981]"></div>
                                    <span class="text-xs text-gray-600 dark:text-gray-400">Admins: <strong>{{ $totalAdmins }}</strong> ({{ $accountPercentages['admins'] }}%)</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-6 space-y-3">
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600 dark:text-gray-400">👤 Clients</span>
                                    <span class="font-semibold text-gray-800 dark:text-white">{{ $totalClients }} ({{ $accountPercentages['clients'] }}%)</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div class="bg-[#FFB703] h-2 rounded-full" style="width: {{ $accountPercentages['clients'] }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600 dark:text-gray-400">👨‍💼 Professionnels</span>
                                    <span class="font-semibold text-gray-800 dark:text-white">{{ $totalProfessionnels }} ({{ $accountPercentages['professionnels'] }}%)</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div class="bg-[#F97316] h-2 rounded-full" style="width: {{ $accountPercentages['professionnels'] }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600 dark:text-gray-400">👑 Administrateurs</span>
                                    <span class="font-semibold text-gray-800 dark:text-white">{{ $totalAdmins }} ({{ $accountPercentages['admins'] }}%)</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div class="bg-[#10B981] h-2 rounded-full" style="width: {{ $accountPercentages['admins'] }}%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-3 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex justify-between">
                                <span class="font-semibold text-gray-700 dark:text-gray-300">📊 Total des comptes</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ $accountDistribution['total'] }}</span>
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
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="usersTableBody" class="divide-y divide-gray-200 dark:divide-gray-700"></tbody>
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
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Ville</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="professionalsTableBody" class="divide-y divide-gray-200 dark:divide-gray-700"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- SECTION CLIENTS -->
            <div id="clientsSection" class="hidden">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-6 py-4">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <h3 class="font-semibold text-white">Gestion des clients</h3>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Client</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Email</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Ville</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="clientsTableBody" class="divide-y divide-gray-200 dark:divide-gray-700"></tbody>
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
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Rôle</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Statut</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="adminsTableBody" class="divide-y divide-gray-200 dark:divide-gray-700"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Données PHP
        const totalUsers = {{ $totalUsers }};
        const totalProfessionnels = {{ $totalProfessionnels }};
        const totalAdmins = {{ $totalAdmins }};
        const totalClients = {{ $totalClients }};
        
        const users = @json($users);
        const professionals = @json($Professionnel);
        const clients = @json($client);
        const admins = @json($admin);
        
        let currentUserFilter = 'all';

        // Dark Mode
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

        // Graphique en camembert
        const ctx = document.getElementById('accountsChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Clients', 'Professionnels', 'Administrateurs'],
                datasets: [{
                    data: [{{ $totalClients }}, {{ $totalProfessionnels }}, {{ $totalAdmins }}],
                    backgroundColor: ['#FFB703', '#F97316', '#10B981'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                cutout: '60%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = {{ $accountDistribution['total'] }};
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
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
            
            // Changer la bordure selon le type
            const borderColors = {
                success: 'border-green-500',
                error: 'border-red-500',
                info: 'border-blue-500'
            };
            toast.querySelector('.border-l-4').className = `bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-4 max-w-sm border-l-4 ${borderColors[type] || borderColors.success}`;
            
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 3000);
        }

        // Fonction changeStatus CORRIGÉE
        function changeStatus(userId, currentStatus, userType) {
            // Demander confirmation
            const action = currentStatus === 'actif' ? 'bannir' : 'réactiver';
            if (!confirm(`Êtes-vous sûr de vouloir ${action} cet utilisateur ?`)) {
                return;
            }
            
            // Afficher un message de chargement
            showNotification('Traitement en cours...', 'info');
            
            fetch(`/admin/user/${userId}/changer-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ 
                    status: currentStatus === 'actif' ? 'banned' : 'actif',
                    user_type: userType 
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification(data.message || `Statut modifié avec succès !`, 'success');
                    // Recharger la page après 1.5 secondes pour voir les changements
                    setTimeout(() => location.reload(), 1500);
                } else {
                    showNotification(data.message || 'Erreur lors de la modification', 'error');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showNotification('Erreur réseau. Veuillez réessayer.', 'error');
            });
        }

        // Fonction pour bannir/débannir les professionnels
        function changeProfessionalStatus(userId, currentStatus) {
            changeStatus(userId, currentStatus, 'professional');
        }

        // Fonction pour bannir/débannir les clients
        function changeClientStatus(userId, currentStatus) {
            changeStatus(userId, currentStatus, 'client');
        }

        // Render Functions CORRIGÉES avec les bons IDs
        function renderUsersTable() {
            const tbody = document.getElementById('usersTableBody');
            if (!tbody) return;
            
            let filteredUsers = users;
            if (currentUserFilter === 'active') {
                filteredUsers = users.filter(u => u.status === 'actif');
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
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${user.email}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${user.city || '-'}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium ${user.status === 'actif' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'}">
                            ${user.status === 'actif' ? 'Actif' : 'Banni'}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <button onclick="changeStatus(${user.id}, '${user.status}', 'user')" 
                                class="p-1.5 ${user.status === 'actif' ? 'bg-red-100 dark:bg-red-900/30 text-red-600 hover:bg-red-200' : 'bg-green-100 dark:bg-green-900/30 text-green-600 hover:bg-green-200'} rounded-lg transition"
                                title="${user.status === 'actif' ? 'Bannir' : 'Réactiver'}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${user.status === 'actif' ? 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636' : 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'}"/>
                            </svg>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function renderProfessionalsTable() {
            const tbody = document.getElementById('professionalsTableBody');
            if (!tbody) return;
            
            tbody.innerHTML = professionals.map(pro => {
                const user = pro.user || { id: pro.id, name: 'N/A', email: 'N/A', city: '-', status: 'actif' };
                return `
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=${user.name}&background=0A2647&color=FFB703&size=40" class="w-10 h-10 rounded-full object-cover">
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">${user.name}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${user.email}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${user.city || '-'}</td>
                    <td class="px-6 py-4">
                        <button onclick="changeProfessionalStatus(${user.id}, '${user.status}')" 
                                class="p-1.5 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-lg hover:bg-red-200 transition"
                                title="Bannir/Débannir">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                            </svg>
                        </button>
                    </td>
                </tr>
            `}).join('');
        }

        function renderClientsTable() {
            const tbody = document.getElementById('clientsTableBody');
            if (!tbody) return;
            
            tbody.innerHTML = clients.map(client => {
                const user = client.user || { id: client.id, name: 'N/A', email: 'N/A', city: '-', status: 'actif' };
                return `
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=${user.name}&background=0A2647&color=FFB703&size=40" class="w-10 h-10 rounded-full object-cover">
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">${user.name}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${user.email}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${user.city || '-'}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium ${user.status === 'actif' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'}">
                            ${user.status === 'actif' ? 'Actif' : 'Banni'}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <button onclick="changeClientStatus(${user.id}, '${user.status}')" 
                                class="p-1.5 ${user.status === 'actif' ? 'bg-red-100 dark:bg-red-900/30 text-red-600 hover:bg-red-200' : 'bg-green-100 dark:bg-green-900/30 text-green-600 hover:bg-green-200'} rounded-lg transition"
                                title="${user.status === 'actif' ? 'Bannir' : 'Réactiver'}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${user.status === 'actif' ? 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636' : 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'}"/>
                            </svg>
                        </button>
                    </td>
                </tr>
            `}).join('');
        }

        function renderAdminsTable() {
            const tbody = document.getElementById('adminsTableBody');
            if (!tbody) return;
            
            tbody.innerHTML = admins.map(admin => {
                const user = admin.user || { name: 'N/A' };
                return `
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name=${user.name}&background=0A2647&color=FFB703&size=40" class="w-10 h-10 rounded-full object-cover">
                            <div>
                                <p class="font-medium text-gray-800 dark:text-white">${user.name}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${admin.role || 'admin'}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Actif</span>
                    </td>
                    <td class="px-6 py-4">
                        <button class="p-1.5 bg-gray-100 dark:bg-gray-700 text-gray-600 rounded-lg cursor-not-allowed" disabled title="Action non disponible pour les admins">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </button>
                    </td>
                </tr>
            `}).join('');
        }

        function filterUsers(filter) {
            currentUserFilter = filter;
            renderUsersTable();
            
            const buttons = document.querySelectorAll('.filter-users-btn');
            if (buttons.length >= 3) {
                buttons.forEach(btn => {
                    btn.classList.remove('bg-[#FFB703]', 'text-[#0A2647]', 'bg-green-500', 'bg-red-500', 'text-white');
                    btn.classList.add('bg-gray-600/20', 'text-gray-400');
                });
                if (filter === 'all') {
                    buttons[0].classList.remove('bg-gray-600/20', 'text-gray-400');
                    buttons[0].classList.add('bg-[#FFB703]', 'text-[#0A2647]');
                } else if (filter === 'active') {
                    buttons[1].classList.remove('bg-gray-600/20', 'text-gray-400');
                    buttons[1].classList.add('bg-green-500', 'text-white');
                } else if (filter === 'banned') {
                    buttons[2].classList.remove('bg-gray-600/20', 'text-gray-400');
                    buttons[2].classList.add('bg-red-500', 'text-white');
                }
            }
        }

        function showSection(section) {
            const sections = ['dashboardSection', 'usersSection', 'professionalsSection', 'clientsSection', 'adminsSection'];
            sections.forEach(s => {
                const el = document.getElementById(s);
                if (el) el.classList.add('hidden');
            });
            
            const activeSection = document.getElementById(`${section}Section`);
            if (activeSection) activeSection.classList.remove('hidden');
            
            if (section === 'users') renderUsersTable();
            if (section === 'professionals') renderProfessionalsTable();
            if (section === 'clients') renderClientsTable();
            if (section === 'admins') renderAdminsTable();
            
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('text-[#FFB703]', 'bg-[#FFB703]/10');
                item.classList.add('text-gray-700', 'dark:text-gray-300');
            });
            
            const activeLink = document.querySelector(`.nav-item[onclick="showSection('${section}')"]`);
            if (activeLink) {
                activeLink.classList.add('text-[#FFB703]', 'bg-[#FFB703]/10');
            }
        }

        // Recherche en temps réel
        document.getElementById('searchInput')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const currentSection = document.querySelector('[id$="Section"]:not(.hidden)')?.id;
            
            if (currentSection === 'usersSection') {
                const filtered = users.filter(user => 
                    user.name.toLowerCase().includes(searchTerm) || 
                    user.email.toLowerCase().includes(searchTerm)
                );
                const tbody = document.getElementById('usersTableBody');
                if (tbody) {
                    tbody.innerHTML = filtered.map(user => `
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=${user.name}&background=0A2647&color=FFB703&size=40" class="w-10 h-10 rounded-full object-cover">
                                    <div>
                                        <p class="font-medium text-gray-800 dark:text-white">${user.name}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${user.email}</td>
                            <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">${user.city || '-'}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium ${user.status === 'actif' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400'}">
                                    ${user.status === 'actif' ? 'Actif' : 'Banni'}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <button onclick="changeStatus(${user.id}, '${user.status}', 'user')" 
                                        class="p-1.5 ${user.status === 'actif' ? 'bg-red-100 dark:bg-red-900/30 text-red-600 hover:bg-red-200' : 'bg-green-100 dark:bg-green-900/30 text-green-600 hover:bg-green-200'} rounded-lg transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="${user.status === 'actif' ? 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636' : 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z'}"/>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    `).join('');
                }
            }
        });

        // Initialisation
        function init() {
            renderUsersTable();
            renderProfessionalsTable();
            renderClientsTable();
            renderAdminsTable();
            showSection('dashboard');
        }
        
        init();
    </script>
</body>
</html>