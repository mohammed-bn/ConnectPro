<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Demandes et Messages - ConnectPro</title>
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
        
        .dark .main-content-scroll::-webkit-scrollbar-track {
            background: #374151;
        }
        
        .theme-transition {
            transition: all 0.3s ease;
        }
        
        .request-card, .message-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .request-card:hover, .message-card:hover {
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
        
        .active-tab {
            background-color: #FFB703;
            color: #0A2647;
        }
        
        .dark .active-tab {
            background-color: #FFB703;
            color: #0A2647;
        }
        
        .message-bubble {
            max-width: 70%;
        }
        
        .message-sent {
            background: linear-gradient(135deg, #0A2647, #1E4A6D);
            color: white;
            border-radius: 1rem 1rem 0 1rem;
        }
        
        .message-received {
            background: #f3f4f6;
            color: #1f2937;
            border-radius: 1rem 1rem 1rem 0;
        }
        
        .dark .message-received {
            background: #374151;
            color: #f3f4f6;
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
                <div class="relative">
                    <input type="text" 
                           id="searchInput"
                           placeholder="Rechercher une demande ou un message..." 
                           class="w-full pl-10 pr-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition text-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
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
                    <a href="{{route('professionnel.dashboard')}}" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                        <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="text-sm font-medium">Dashboard</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 bg-gray-100 dark:bg-gray-700 rounded-xl text-[#0A2647] dark:text-white">
                        <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <span class="text-sm font-medium">Demandes</span>
                        <span class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $pendingRequestsCount ?? 0 }}</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                        <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-sm font-medium">Messages</span>
                        <span id="unreadMessagesBadge" class="ml-auto bg-[#FFB703] text-[#0A2647] text-xs px-2 py-0.5 rounded-full">0</span>
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
                
                <!-- TABS -->
                <div class="flex gap-3 mb-6">
                    <button onclick="switchTab('demandes')" id="tabDemandesBtn" class="active-tab px-6 py-2.5 rounded-xl font-semibold transition-all duration-300 shadow-md">
                        📋 Demandes de consultation
                    </button>
                    <button onclick="switchTab('messages')" id="tabMessagesBtn" class="px-6 py-2.5 rounded-xl font-semibold transition-all duration-300 hover:bg-gray-200 dark:hover:bg-gray-700 shadow-md">
                        💬 Messages
                    </button>
                </div>

                <!-- SECTION DEMANDES DE CONSULTATION -->
                <div id="demandesSection" class="space-y-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-[#0A2647] dark:text-white flex items-center gap-2">
                            <svg class="w-6 h-6 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Demandes de consultation
                        </h2>

                    </div>

                    @forelse($demandes ?? [] as $demande)
                    <div class="request-card bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-all" data-request-id="{{ $demande->id }}">
                        <div class="p-5">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $demande->client->user->photo ?? 'https://ui-avatars.com/api/?name='.urlencode($demande->client->user->name).'&background=0A2647&color=FFB703&size=50' }}" 
                                         class="w-12 h-12 rounded-full object-cover border-2 border-[#FFB703]">
                                    <div>
                                        <h3 class="font-bold text-gray-800 dark:text-white">{{ $demande->client->user->name }}</h3>
                                        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            <span>{{ $demande->created_at->diffForHumans() }}</span>
                                            <span>•</span>
                                            <span class="px-2 py-0.5 rounded-full 
                                                @if($demande->status == 'Pending') bg-yellow-100 text-yellow-700
                                                @elseif($demande->status == 'Accepted') bg-green-100 text-green-700
                                                @else bg-red-100 text-red-700 @endif">
                                                @if($demande->status == 'Pending') En attente
                                                @elseif($demande->status == 'Accepted') Acceptée
                                                @else Refusée @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @if($demande->status == 'Pending')
                                <div class="flex gap-2">
                                    <button onclick="acceptRequest({{ $demande->id }})" 
                                            class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition flex items-center gap-1.5 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Accepter
                                    </button>
                                    <button onclick="refuseRequest({{ $demande->id }})" 
                                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition flex items-center gap-1.5 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Refuser
                                    </button>
                                </div>
                                @endif
                            </div>
                            
                            <div class="mt-4">
                                <h4 class="font-semibold text-gray-800 dark:text-white">{{ $demande->title }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $demande->subject }}</p>
                                <div class="mt-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                    <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                        {{ $demande->message }}
                                    </p>
                                </div>
                            </div>
                            
                            @if($demande->status == 'Accepted')
                            <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700">
                                <button onclick="openChat({{ $demande->conversation_id ?? 0 }}, '{{ $demande->client->user->name }}', {{ $demande->client_id }})" 
                                        class="flex items-center gap-2 text-[#FFB703] hover:text-[#E5A500] transition text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    Voir la conversation
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">Aucune demande de consultation</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500 mt-2">Les demandes apparaîtront ici</p>
                    </div>
                    @endforelse
                </div>

                <!-- SECTION MESSAGES -->
                <div id="messagesSection" class="hidden">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-[#0A2647] dark:text-white flex items-center gap-2">
                            <svg class="w-6 h-6 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            Messages
                        </h2>
                    </div>

                    <div class="grid lg:grid-cols-3 gap-6">
                        <!-- Liste des conversations -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                            <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-4 py-3">
                                <h3 class="font-semibold text-white">Conversations</h3>
                            </div>
                            <div id="conversationsList" class="divide-y divide-gray-100 dark:divide-gray-700 max-h-[600px] overflow-y-auto">
                                @forelse($conversations ?? [] as $conversation)
                                <div onclick="loadConversation({{ $conversation->id }}, '{{ $conversation->client->user->name }}', {{ $conversation->client_id }})" 
                                     class="conversation-item p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition cursor-pointer" data-conversation-id="{{ $conversation->id }}">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $conversation->client->user->photo ?? 'https://ui-avatars.com/api/?name='.urlencode($conversation->client->user->name).'&background=0A2647&color=FFB703&size=40' }}" 
                                             class="w-10 h-10 rounded-full object-cover">
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center justify-between">
                                                <h4 class="font-semibold text-gray-800 dark:text-white truncate">{{ $conversation->client->user->name }}</h4>
                                                <span class="text-xs text-gray-400">{{ $conversation->updated_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $conversation->lastMessage->content ?? 'Aucun message' }}</p>
                                        </div>
                                        @if($conversation->unread_count > 0)
                                        <span class="w-2 h-2 bg-[#FFB703] rounded-full"></span>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <div class="p-8 text-center text-gray-500 dark:text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <p class="text-sm">Aucune conversation</p>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Zone de chat -->
                        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden flex flex-col" style="height: 600px;">
                            <div id="chatHeader" class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-4 py-3 hidden">
                                <div class="flex items-center gap-3">
                                    <img id="chatAvatar" src="" class="w-10 h-10 rounded-full object-cover border-2 border-[#FFB703]">
                                    <div>
                                        <h3 id="chatName" class="font-semibold text-white"></h3>
                                        <p id="chatStatus" class="text-xs text-[#FFB703]">En ligne</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="chatMessages" class="flex-1 overflow-y-auto p-4 space-y-3 custom-scrollbar">
                                <div class="text-center text-gray-400 py-8">
                                    <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <p>Sélectionnez une conversation pour commencer</p>
                                </div>
                            </div>
                            
                            <div id="chatInputArea" class="p-4 border-t border-gray-100 dark:border-gray-700 hidden">
                                <form id="sendMessageForm" class="flex gap-2">
                                    @csrf
                                    <input type="hidden" id="currentConversationId" name="conversation_id" value="">
                                    <input type="text" id="messageContent" name="content" placeholder="Écrivez votre message..." 
                                           class="flex-1 p-2 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none text-sm">
                                    <button type="submit" class="px-4 py-2 bg-[#FFB703] text-[#0A2647] rounded-xl hover:bg-[#E5A500] transition font-semibold">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
            
            const colors = {
                success: 'border-green-500',
                error: 'border-red-500',
                warning: 'border-yellow-500'
            };
            
            toast.querySelector('.border-l-4').className = `border-l-4 ${colors[type] || colors.success}`;
            toast.classList.remove('hidden');
            
            setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }
        
        // Tab switching
        function switchTab(tab) {
            const demandesSection = document.getElementById('demandesSection');
            const messagesSection = document.getElementById('messagesSection');
            const tabDemandesBtn = document.getElementById('tabDemandesBtn');
            const tabMessagesBtn = document.getElementById('tabMessagesBtn');
            
            if (tab === 'demandes') {
                demandesSection.classList.remove('hidden');
                messagesSection.classList.add('hidden');
                tabDemandesBtn.classList.add('active-tab');
                tabMessagesBtn.classList.remove('active-tab');
            } else {
                demandesSection.classList.add('hidden');
                messagesSection.classList.remove('hidden');
                tabMessagesBtn.classList.add('active-tab');
                tabDemandesBtn.classList.remove('active-tab');
                loadConversations();
            }
        }
        
        // Demandes functions
        function acceptRequest(requestId) {
            $.ajax({
                url: `/consultation/accept/${requestId}`,
                type: 'POST',
                data: { _token: $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    showNotification('Demande acceptée avec succès', 'success');
                    setTimeout(() => location.reload(), 1500);
                },
                error: function(xhr) {
                    showNotification('Erreur lors de l\'acceptation', 'error');
                }
            });
        }
        
        function refuseRequest(requestId) {
            $.ajax({
                url: `/consultation/refuse/${requestId}`,
                type: 'POST',
                data: { _token: $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    showNotification('Demande refusée', 'success');
                    setTimeout(() => location.reload(), 1500);
                },
                error: function(xhr) {
                    showNotification('Erreur lors du refus', 'error');
                }
            });
        }
        
        // Messages functions
        let currentConversationId = null;
        let pollingInterval = null;
        
        function loadConversations() {
            $.ajax({
                url: '#',
                type: 'GET',
                success: function(response) {
                    const container = $('#conversationsList');
                    container.empty();
                    
                    if (response.conversations.length === 0) {
                        container.html(`
                            <div class="p-8 text-center text-gray-500 dark:text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                <p class="text-sm">Aucune conversation</p>
                            </div>
                        `);
                        return;
                    }
                    
                    response.conversations.forEach(conv => {
                        container.append(`
                            <div onclick="loadConversation(${conv.id}, '${escapeHtml(conv.client_name)}', ${conv.client_id})" 
                                 class="conversation-item p-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition cursor-pointer" data-conversation-id="${conv.id}">
                                <div class="flex items-center gap-3">
                                    <img src="${conv.client_photo || 'https://ui-avatars.com/api/?name=' + encodeURIComponent(conv.client_name) + '&background=0A2647&color=FFB703&size=40'}" 
                                         class="w-10 h-10 rounded-full object-cover">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <h4 class="font-semibold text-gray-800 dark:text-white truncate">${escapeHtml(conv.client_name)}</h4>
                                            <span class="text-xs text-gray-400">${conv.updated_at}</span>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">${escapeHtml(conv.last_message || 'Aucun message')}</p>
                                    </div>
                                    ${conv.unread_count > 0 ? '<span class="w-2 h-2 bg-[#FFB703] rounded-full"></span>' : ''}
                                </div>
                            </div>
                        `);
                    });
                    
                    $('#unreadMessagesBadge').text(response.total_unread);
                },
                error: function(xhr) {
                    console.error('Error loading conversations:', xhr);
                }
            });
        }
        
        function loadConversation(conversationId, clientName, clientId) {
            currentConversationId = conversationId;
            
            $('#currentConversationId').val(conversationId);
            $('#chatName').text(clientName);
            $('#chatAvatar').attr('src', `https://ui-avatars.com/api/?name=${encodeURIComponent(clientName)}&background=0A2647&color=FFB703&size=50`);
            $('#chatHeader').removeClass('hidden');
            $('#chatInputArea').removeClass('hidden');
            
            loadMessages(conversationId);
            
            if (pollingInterval) clearInterval(pollingInterval);
            pollingInterval = setInterval(() => loadMessages(conversationId), 5000);
        }
        
        function loadMessages(conversationId) {
            $.ajax({
                url: `/conversations/${conversationId}/messages`,
                type: 'GET',
                success: function(response) {
                    renderMessages(response.messages);
                    
                    // Marquer comme lu
                    $.ajax({
                        url: `/conversations/${conversationId}/read`,
                        type: 'POST',
                        data: { _token: $('meta[name="csrf-token"]').attr('content') },
                        success: function() {
                            loadConversations();
                        }
                    });
                },
                error: function(xhr) {
                    console.error('Error loading messages:', xhr);
                }
            });
        }
        
        function renderMessages(messages) {
            const container = $('#chatMessages');
            container.empty();
            
            if (messages.length === 0) {
                container.html(`
                    <div class="text-center text-gray-400 py-8">
                        <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <p>Aucun message</p>
                        <p class="text-xs mt-1">Soyez le premier à envoyer un message</p>
                    </div>
                `);
                return;
            }
            
            messages.forEach(msg => {
                const isSent = msg.user_id === {{ Auth::id() }};
                container.append(`
                    <div class="flex ${isSent ? 'justify-end' : 'justify-start'}">
                        <div class="message-bubble ${isSent ? 'message-sent' : 'message-received'} p-3">
                            <p class="text-sm">${escapeHtml(msg.content)}</p>
                            <p class="text-xs opacity-70 mt-1">${msg.created_at}</p>
                        </div>
                    </div>
                `);
            });
            
            container.scrollTop(container[0].scrollHeight);
        }
        
        // Send message
        $('#sendMessageForm').on('submit', function(e) {
            e.preventDefault();
            
            const content = $('#messageContent').val().trim();
            if (!content) return;
            
            $.ajax({
                url: '#',
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    conversation_id: currentConversationId,
                    content: content
                },
                success: function(response) {
                    if (response.success) {
                        $('#messageContent').val('');
                        loadMessages(currentConversationId);
                        loadConversations();
                    }
                },
                error: function(xhr) {
                    showNotification('Erreur lors de l\'envoi', 'error');
                }
            });
        });
        
        function openChat(conversationId, clientName, clientId) {
            switchTab('messages');
            setTimeout(() => loadConversation(conversationId, clientName, clientId), 100);
        }
        
        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        
        $(document).ready(function() {
            loadConversations();
        });
    </script>
</body>
</html>