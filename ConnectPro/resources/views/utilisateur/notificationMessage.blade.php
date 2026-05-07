<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Notifications - ConnectPro</title>
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
        
        .main-content-scroll::-webkit-scrollbar-thumb:hover {
            background: #E5A500;
        }
        
        .dark .main-content-scroll::-webkit-scrollbar-track {
            background: #374151;
        }
        
        .theme-transition {
            transition: all 0.3s ease;
        }
        
        .notification-card {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        
        .notification-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .notification-unread {
            background: linear-gradient(135deg, rgba(255, 183, 3, 0.05) 0%, rgba(255, 183, 3, 0.02) 100%);
            border-left: 3px solid #FFB703;
        }
        
        .status-badge {
            transition: all 0.2s ease;
        }
        
        .status-badge:hover {
            transform: scale(1.05);
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        .pulse-dot {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        .tab-active {
            background: linear-gradient(135deg, #0A2647 0%, #1E4A6D 100%);
            color: white;
        }
        
        .tab-inactive {
            background: transparent;
            color: #6B7280;
        }
        
        .tab-inactive:hover {
            background: rgba(0, 0, 0, 0.05);
        }
        
        .dark .tab-inactive:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        
        .loading-spinner {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
    
     @include('utilisateur._header')
     
    <div class="flex pt-16">
        
        <!-- SIDEBAR -->
        <aside class="fixed left-0 top-16 h-[calc(100vh-64px)] w-72 bg-white dark:bg-gray-800 shadow-2xl z-30 flex flex-col transition-colors">
            
            <div class="p-5 border-b border-gray-200 dark:border-gray-700">
                <div class="flex flex-col items-center text-center">
                    <div class="relative">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Jean Dupont') }}&background=0A2647&color=FFB703&size=100"
                             class="w-20 h-20 rounded-full object-cover border-4 border-[#FFB703] shadow-lg">
                        <div class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <h3 class="mt-3 font-bold text-[#0A2647] dark:text-white">{{ Auth::user()->name ?? 'Jean Dupont' }}</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Client</p>
                    
                    <a href="{{ route('profileUt.edit') }}" class="mt-3 w-full flex items-center justify-center gap-1.5 px-3 py-1.5 text-xs font-medium text-[#0A2647] dark:text-white bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
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

                    <a href="{{route('demandes.index')}}" class="flex items-center gap-3 px-4 py-3 bg-gray-100 dark:bg-gray-700 rounded-xl text-[#0A2647] dark:text-white">
                        <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="text-sm font-medium">Notifications</span>
                        <span class="ml-auto bg-[#FFB703] text-[#0A2647] text-xs px-2 py-0.5 rounded-full" id="unreadCount">0</span>
                    </a>

                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition group">
                        <svg class="w-5 h-5 group-hover:text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <span class="text-sm font-medium">Publications</span>
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
                
                <!-- Page Header -->
                <div class="mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-[#0A2647] dark:text-white">Notifications</h1>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Suivez le statut de vos demandes de consultation</p>
                        </div>
                        <button onclick="refreshNotifications()" 
                                class="px-4 py-2 text-sm bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:border-[#FFB703] hover:text-[#FFB703] transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Actualiser
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-xl p-4 border border-green-200 dark:border-green-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-green-600 dark:text-green-400">Acceptées</p>
                                <p class="text-2xl font-bold text-green-700 dark:text-green-300" id="statsAccepted">{{ $totalAccepted }}</p>
                            </div>
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 dark:from-yellow-900/20 dark:to-yellow-800/20 rounded-xl p-4 border border-yellow-200 dark:border-yellow-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-yellow-600 dark:text-yellow-400">En attente</p>
                                <p class="text-2xl font-bold text-yellow-700 dark:text-yellow-300" id="statsPending">{{ $totalPending ?? 0 }}</p>
                            </div>
                            <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 rounded-xl p-4 border border-red-200 dark:border-red-800">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-red-600 dark:text-red-400">Refusées</p>
                                <p class="text-2xl font-bold text-red-700 dark:text-red-300" id="statsRefused">{{ $totalRefused ?? 0 }}</p>
                            </div>
                            <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="flex gap-2 mb-6 border-b border-gray-200 dark:border-gray-700">
                    <button onclick="switchTab('all')" id="tab-all" class="tab-active px-6 py-2.5 rounded-t-lg font-medium transition-all duration-300">
                        Toutes
                        <span id="count-all" class="ml-2 text-xs bg-white/20 px-2 py-0.5 rounded-full">0</span>
                    </button>
                    <button onclick="switchTab('demandes')" id="tab-demandes" class="tab-inactive px-6 py-2.5 rounded-t-lg font-medium transition-all duration-300">
                        Demandes de consultation
                        <span id="count-demandes" class="ml-2 text-xs bg-gray-200 dark:bg-gray-700 px-2 py-0.5 rounded-full">0</span>
                    </button>
                </div>

                <!-- Notifications Container -->
                <div id="notificationsContainer" class="space-y-3">
                    <div class="text-center py-12">
                        <div class="inline-block loading-spinner rounded-full h-8 w-8 border-b-2 border-[#FFB703]"></div>
                        <p class="text-gray-500 dark:text-gray-400 mt-3">Chargement des demandes...</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        let demandesData = @json($demandes);
        let currentTab = 'all';
        let searchTerm = '';

        // Fonction pour formater la date relative
        function formatRelativeDate(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffMs = now - date;
            const diffMins = Math.floor(diffMs / 60000);
            const diffHours = Math.floor(diffMs / 3600000);
            const diffDays = Math.floor(diffMs / 86400000);

            if (diffMins < 1) return "À l'instant";
            if (diffMins < 60) return `Il y a ${diffMins} minute${diffMins > 1 ? 's' : ''}`;
            if (diffHours < 24) return `Il y a ${diffHours} heure${diffHours > 1 ? 's' : ''}`;
            if (diffDays === 1) return 'Hier';
            if (diffDays < 7) return `Il y a ${diffDays} jours`;
            return date.toLocaleDateString('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' });
        }

        // Fonction pour obtenir le badge de statut
        function getStatusBadge(status) {
            const statusConfig = {
                'acceptée': { bg: 'bg-green-100 dark:bg-green-900', text: 'text-green-700 dark:text-green-300', icon: '✓', label: 'Acceptée' },
                'accepte': { bg: 'bg-green-100 dark:bg-green-900', text: 'text-green-700 dark:text-green-300', icon: '✓', label: 'Acceptée' },
                'en_attente': { bg: 'bg-yellow-100 dark:bg-yellow-900', text: 'text-yellow-700 dark:text-yellow-300', icon: '⏳', label: 'En attente' },
                'en attente': { bg: 'bg-yellow-100 dark:bg-yellow-900', text: 'text-yellow-700 dark:text-yellow-300', icon: '⏳', label: 'En attente' },
                'refusée': { bg: 'bg-red-100 dark:bg-red-900', text: 'text-red-700 dark:text-red-300', icon: '✗', label: 'Refusée' },
                'refuse': { bg: 'bg-red-100 dark:bg-red-900', text: 'text-red-700 dark:text-red-300', icon: '✗', label: 'Refusée' }
            };
            
            let statusKey = String(status).toLowerCase();
            const config = statusConfig[statusKey] || statusConfig['en_attente'];
            
            return `<span class="status-badge inline-flex items-center gap-1 ${config.bg} ${config.text} text-xs px-2 py-1 rounded-full font-medium">
                        <span>${config.icon}</span>
                        <span>${config.label}</span>
                    </span>`;
        }

        // Fonction pour obtenir le message selon le statut
        function getStatusMessage(demande) {
            const status = demande.status;
            const profName = demande.professionnel?.user?.name || 'un professionnel';
            const specialty = demande.professionnel?.specialty?.name || '';
            
            switch(status) {
                case 'acceptée':
                case 'accepte':
                    return `${profName} a accepté votre demande de consultation${specialty ? ' en ' + specialty : ''}. Votre rendez-vous est confirmé.`;
                case 'refusée':
                case 'refuse':
                    return `${profName} a dû refuser votre demande de consultation. Veuillez contacter le professionnel pour plus d'informations.`;
                default:
                    return `Votre demande de consultation chez ${profName} est en cours de traitement. Vous serez notifié dès qu'une réponse sera disponible.`;
            }
        }

        // Fonction pour obtenir le titre selon le statut
        function getStatusTitle(status) {
            switch(status) {
                case 'acceptée':
                case 'accepte':
                    return 'Demande de consultation acceptée';
                case 'refusée':
                case 'refuse':
                    return 'Demande de consultation refusée';
                default:
                    return 'Demande de consultation en attente';
            }
        }

        // Fonction pour obtenir l'icône selon le statut
        function getStatusIcon(status) {
            const statusLower = String(status).toLowerCase();
            if (statusLower === 'acceptée' || statusLower === 'accepte') {
                return {
                    icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    bg: 'bg-green-100 dark:bg-green-900'
                };
            } else if (statusLower === 'refusée' || statusLower === 'refuse') {
                return {
                    icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    bg: 'bg-red-100 dark:bg-red-900'
                };
            } else {
                return {
                    icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                    bg: 'bg-yellow-100 dark:bg-yellow-900'
                };
            }
        }

        // Fonction pour rendre une notification
        function renderDemande(demande) {
            const isUnread = !demande.is_read;
            const dateFormatted = formatRelativeDate(demande.created_at);
            const statusMessage = getStatusMessage(demande);
            const statusTitle = getStatusTitle(demande.status);
            const statusIcon = getStatusIcon(demande.status);
            const profName = demande.professionnel?.user?.name || 'Professionnel';
            const specialty = demande.professionnel?.specialty?.name || '';
            const appointmentDate = demande.date_consultation ? new Date(demande.date_consultation).toLocaleDateString('fr-FR', {
                day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit'
            }) : null;

            let actionButtons = '';
            if (demande.status === 'acceptée' || demande.status === 'accepte') {
                actionButtons = `
                    <div class="flex gap-2 mt-3">
                        <button onclick="viewDemandeDetails(${demande.id})" 
                                class="px-3 py-1.5 text-xs bg-[#FFB703] text-[#0A2647] rounded-lg hover:bg-[#E5A500] transition font-medium">
                            Voir les détails
                        </button>
                        <button onclick="startConversation(${demande.professionnel?.user?.id || 0})" 
                                class="px-3 py-1.5 text-xs border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:border-[#FFB703] transition">
                            Contacter
                        </button>
                    </div>
                `;
            }

            return `
                <div class="notification-card ${isUnread ? 'notification-unread' : ''} bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-all border border-gray-200 dark:border-gray-700">
                    <div class="p-5">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 ${statusIcon.bg} rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        ${statusIcon.icon}
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-1 flex-wrap">
                                            <h3 class="font-semibold text-gray-800 dark:text-white">${escapeHtml(statusTitle)}</h3>
                                            ${!demande.is_read ? '<span class="pulse-dot w-2 h-2 bg-[#FFB703] rounded-full"></span>' : ''}
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">${escapeHtml(statusMessage)}</p>
                                        <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500 dark:text-gray-500 mb-2">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                                ${escapeHtml(profName)}
                                            </span>
                                            ${specialty ? `
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                                    </svg>
                                                    ${escapeHtml(specialty)}
                                                </span>
                                            ` : ''}
                                            <span class="flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                ${dateFormatted}
                                            </span>
                                        </div>
                                        ${appointmentDate ? `
                                            <div class="mb-2 p-2 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                                <span class="text-xs text-gray-600 dark:text-gray-400 flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    Rendez-vous prévu le ${appointmentDate}
                                                </span>
                                            </div>
                                        ` : ''}
                                        ${getStatusBadge(demande.status)}
                                        ${actionButtons}
                                    </div>
                                    <button onclick="markAsRead(${demande.id})" 
                                            class="text-gray-400 hover:text-[#FFB703] transition p-1 ${demande.is_read ? 'opacity-50' : ''}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function escapeHtml(text) {
            if (!text) return '';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        function filterNotifications() {
            let filtered = demandesData;
            
            if (currentTab !== 'all') {
                filtered = filtered.filter(d => d.type === currentTab);
            }
            
            if (searchTerm) {
                const term = searchTerm.toLowerCase();
                filtered = filtered.filter(d => {
                    const profName = d.professionnel?.user?.name || '';
                    const specialty = d.professionnel?.specialty?.name || '';
                    return d.motif?.toLowerCase().includes(term) ||
                           profName.toLowerCase().includes(term) ||
                           specialty.toLowerCase().includes(term) ||
                           d.status.toLowerCase().includes(term);
                });
            }
            
            return filtered;
        }

        function updateCounts() {
            const allCount = demandesData.length;
            const demandesCount = demandesData.length;
            
            // Stats par statut
            const accepted = demandesData.filter(d => d.status === 'acceptée' || d.status === 'accepte').length;
            const pending = demandesData.filter(d => d.status === 'en_attente' || d.status === 'en attente').length;
            const refused = demandesData.filter(d => d.status === 'refusée' || d.status === 'refuse').length;
            
            document.getElementById('count-all').textContent = allCount;
            document.getElementById('count-demandes').textContent = demandesCount;
            document.getElementById('statsAccepted').textContent = accepted;
            document.getElementById('statsPending').textContent = pending;
            document.getElementById('statsRefused').textContent = refused;
            
            const unreadCount = demandesData.filter(d => !d.is_read).length;
            document.getElementById('unreadCount').textContent = unreadCount;
        }

        function renderNotifications() {
            const container = document.getElementById('notificationsContainer');
            const filtered = filterNotifications();
            
            if (filtered.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-xl transition-colors">
                        <svg class="w-20 h-20 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400">Aucune demande de consultation</p>
                        <p class="text-sm text-gray-400 dark:text-gray-500 mt-2">Vous n'avez encore fait aucune demande.</p>
                        <a href="{{ route('search.professionals') }}" class="inline-block mt-4 px-4 py-2 bg-[#FFB703] text-[#0A2647] rounded-lg hover:bg-[#E5A500] transition">
                            Trouver un professionnel
                        </a>
                    </div>
                `;
                return;
            }
            
            container.innerHTML = filtered.map(renderDemande).join('');
        }

        function switchTab(tab) {
            currentTab = tab;
            
            document.querySelectorAll('[id^="tab-"]').forEach(btn => {
                btn.classList.remove('tab-active');
                btn.classList.add('tab-inactive');
            });
            document.getElementById(`tab-${tab}`).classList.remove('tab-inactive');
            document.getElementById(`tab-${tab}`).classList.add('tab-active');
            
            renderNotifications();
        }

        function markAsRead(demandeId) {
            const demande = demandesData.find(d => d.id === demandeId);
            if (demande && !demande.is_read) {
                demande.is_read = true;
                
                // Envoyer la requête AJAX pour mettre à jour dans la base de données
                $.ajax({
                    url: `/api/notifications/${demandeId}/read`,
                    type: 'PUT',
                    data: { type: 'demande' },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('Marqué comme lu');
                    },
                    error: function(xhr) {
                        console.error('Erreur:', xhr);
                    }
                });
                
                updateCounts();
                renderNotifications();
            }
        }

        function refreshNotifications() {
            $('#notificationsContainer').html(`
                <div class="text-center py-12">
                    <div class="inline-block loading-spinner rounded-full h-8 w-8 border-b-2 border-[#FFB703]"></div>
                    <p class="text-gray-500 dark:text-gray-400 mt-3">Actualisation...</p>
                </div>
            `);
            
            $.ajax({
                url: "{{ route('demandes.index') }}",
                type: "GET",
                success: function(data) {
                    demandesData = data;
                    updateCounts();
                    renderNotifications();
                },
                error: function(xhr) {
                    console.error('Erreur:', xhr);
                    renderNotifications();
                }
            });
        }

        function viewDemandeDetails(demandeId) {
            window.location.href = `/demande/${demandeId}`;
        }

        function startConversation(professionalId) {
            if (professionalId) {
                window.location.href = `/conversation/start/${professionalId}`;
            }
        }

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

        // Search functionality
        const searchInput = document.getElementById('searchNotifications');
        searchInput.addEventListener('input', function(e) {
            searchTerm = e.target.value;
            renderNotifications();
        });

        // Initial render
        updateCounts();
        renderNotifications();
    </script>
</body>
</html>