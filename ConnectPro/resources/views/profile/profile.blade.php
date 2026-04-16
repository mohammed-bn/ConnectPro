@extends('layouts.app')

@section('title', 'Profil Professionnel - ConnectPro')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-8">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid lg:grid-cols-3 gap-8">
            
            <!-- ==================== LEFT PANEL - CARTE PROFIL ==================== -->
            <aside class="space-y-6">
                
                <!-- CARTE DE PROFIL PRINCIPALE -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <!-- Bannière de fond -->
                    <div class="h-24 bg-gradient-to-r from-[#0A2647] to-[#1E4A6D]"></div>
                    
                    <div class="relative px-6 pb-6">
                        <!-- Photo de profil -->
                        <div class="flex justify-center -mt-12 mb-4">
                            <div class="relative">
                                <img src="{{ $user->photo ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0A2647&color=FFB703&size=120' }}"
                                     alt="Photo de profil"
                                     class="w-28 h-28 rounded-full object-cover border-4 border-white dark:border-gray-800 shadow-lg">
                                <div class="absolute bottom-0 right-0 w-5 h-5 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                            </div>
                        </div>
                        
                        <!-- Informations utilisateur -->
                        <div class="text-center">
                            <h2 class="text-2xl font-bold text-[#0A2647] dark:text-white">{{ $user->name }}</h2>
                            <p class="text-[#FFB703] font-medium mt-1">{{ $user->speciality ?? 'Professionnel certifié' }}</p>
                            <div class="flex items-center justify-center gap-2 mt-2 text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-sm">{{ $user->city ?? 'Ville non définie' }}</span>
                            </div>
                        </div>
                        
                        <!-- Bouton modifier -->
                        <div class="mt-4">
                            <a href="{{ route('profile.edit') }}" 
                               class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] hover:from-[#1E4A6D] hover:to-[#2C7DA0] text-white font-semibold py-2.5 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                Modifier mon profil
                            </a>
                        </div>
                    </div>
                </div>

                <!-- STATISTIQUES RAPIDES -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-2.5 text-center">
                        <div class="text-xl font-bold text-[#0A2647] dark:text-white">45</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Publications</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-2.5 text-center">
                        <div class="text-xl font-bold text-[#0A2647] dark:text-white">12</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Consultations</div>
                    </div>
                </div>

                <!-- CARTE INVITATIONS / DEMANDES -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-5 py-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <h3 class="font-semibold text-white">Invitations / Demandes</h3>
                        </div>
                    </div>
                    <div class="p-5">
                        @forelse($user->invitations ?? [] as $inv)
                            <div class="flex items-center justify-between py-3 border-b border-gray-100 dark:border-gray-700 last:border-0">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($inv->client->name ?? 'Client') }}&background=FFB703&color=0A2647&size=40" 
                                         class="w-10 h-10 rounded-full">
                                    <div>
                                        <p class="font-medium text-gray-800 dark:text-white">{{ $inv->client->name ?? 'Utilisateur' }}</p>
                                        <p class="text-xs text-gray-500">Demande de consultation</p>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <button class="p-1.5 bg-green-100 dark:bg-green-900/30 text-green-600 rounded-lg hover:bg-green-200 transition">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                    <button class="p-1.5 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-lg hover:bg-red-200 transition">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <svg class="w-12 h-12 mx-auto text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Aucune invitation en attente</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- CARTE CONTACT RAPIDE -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <h3 class="font-semibold text-gray-800 dark:text-white">Contact rapide</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $user->email }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>{{ $user->phone ?? 'Non renseigné' }}</span>
                        </div>
                    </div>
                </div>

            </aside>

            <!-- ==================== MAIN PANEL ==================== -->
            <main class="lg:col-span-2 space-y-6">

                <!-- SECTION À PROPOS -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-6 py-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h3 class="font-semibold text-white">À propos de moi</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            {{ $user->bio ?? 'Aucune description pour le moment. Cliquez sur "Modifier mon profil" pour ajouter une présentation.' }}
                        </p>
                        
                        <!-- Informations détaillées - Toutes au même niveau -->
                        <div class="mt-6 grid sm:grid-cols-2 gap-4">
                            <!-- Catégorie -->
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                <div class="w-8 h-8 bg-[#FFB703]/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Catégorie</p>
                                    <p class="font-medium text-gray-800 dark:text-white">{{ $user->category ?? 'Non défini' }}</p>
                                </div>
                            </div>

                            <!-- Spécialité -->
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                <div class="w-8 h-8 bg-[#FFB703]/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Spécialité</p>
                                    <p class="font-medium text-gray-800 dark:text-white">{{ $user->speciality ?? 'Non défini' }}</p>
                                </div>
                            </div>

                            <!-- Téléphone -->
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                <div class="w-8 h-8 bg-[#FFB703]/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Téléphone</p>
                                    <p class="font-medium text-gray-800 dark:text-white">{{ $user->phone ?? 'Non renseigné' }}</p>
                                </div>
                            </div>

                            <!-- Ville -->
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                <div class="w-8 h-8 bg-[#FFB703]/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Ville</p>
                                    <p class="font-medium text-gray-800 dark:text-white">{{ $user->city ?? 'Non défini' }}</p>
                                </div>
                            </div>

                            <!-- Région -->
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                <div class="w-8 h-8 bg-[#FFB703]/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Région</p>
                                    <p class="font-medium text-gray-800 dark:text-white">{{ $user->region ?? 'Non défini' }}</p>
                                </div>
                            </div>

                            <!-- Adresse (maintenant au même niveau que les autres) -->
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                <div class="w-8 h-8 bg-[#FFB703]/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Adresse</p>
                                    <p class="font-medium text-gray-800 dark:text-white">{{ $user->address ?? 'Non définie' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION PUBLICATIONS -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-6 py-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                <h3 class="font-semibold text-white">Mes publications</h3>
                            </div>
                            <span class="text-xs text-[#FFB703]">{{ rand(5, 20)}} publications</span>
                        </div>
                    </div>
                    
                    <div class="p-5 space-y-5 max-h-[500px] overflow-y-auto custom-scrollbar">
                        
                        @forelse($user->posts ?? [] as $post)
                        <div class="border-b border-gray-100 dark:border-gray-700 pb-5 last:border-0 last:pb-0">
                            <div class="flex items-center gap-3 mb-3">
                                <img src="{{ $user->photo ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0A2647&color=FFB703&size=40' }}"
                                     class="w-10 h-10 rounded-full object-cover">
                                <div>
                                    <h4 class="font-bold text-gray-800 dark:text-white">{{ $user->name }}</h4>
                                    <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() ?? 'Publié récemment' }}</p>
                                </div>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-3">
                                {{ $post->content ?? 'Exemple de contenu de publication professionnel. Partagez vos offres, conseils ou actualités avec votre réseau.' }}
                            </p>
                            @if($post->image ?? false)
                                <img src="{{ $post->image }}" class="rounded-xl mb-3 max-h-64 w-full object-cover">
                            @endif
                            <div class="flex gap-4 text-sm">
                                <button class="flex items-center gap-1 text-gray-500 hover:text-red-500 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    <span>Like</span>
                                </button>
                                <button class="flex items-center gap-1 text-gray-500 hover:text-[#FFB703] transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <span>Commenter</span>
                                </button>
                                <button class="flex items-center gap-1 text-gray-500 hover:text-green-500 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                    </svg>
                                    <span>Partager</span>
                                </button>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400">Aucune publication pour le moment</p>
                            <p class="text-sm text-gray-400 mt-1">Commencez à partager votre expertise !</p>
                        </div>
                        @endforelse
                        
                        @if(empty($user->posts))
                        <div class="border-b border-gray-100 dark:border-gray-700 pb-5">
                            <div class="flex items-center gap-3 mb-3">
                                <img src="{{ $user->photo ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0A2647&color=FFB703&size=40' }}"
                                     class="w-10 h-10 rounded-full object-cover">
                                <div>
                                    <h4 class="font-bold text-gray-800 dark:text-white">{{ $user->name }}</h4>
                                    <p class="text-xs text-gray-500">Il y a 2 jours</p>
                                </div>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-3">
                                Je suis ravi de vous annoncer l'ouverture de mon cabinet de consultation. N'hésitez pas à me contacter pour toute demande !
                            </p>
                            <div class="flex gap-4 text-sm">
                                <button class="flex items-center gap-1 text-gray-500 hover:text-red-500 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    <span>24 likes</span>
                                </button>
                                <button class="flex items-center gap-1 text-gray-500 hover:text-[#FFB703] transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <span>8 commentaires</span>
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

<!-- STYLES PERSONNALISÉS -->
<style>
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
</style>

@endsection