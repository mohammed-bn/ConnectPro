@extends('layouts.app')

@section('title', 'Profil Professionnel - ConnectPro')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-8">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Messages de succès/erreur -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-r-lg">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-r-lg">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-r-lg">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-8">
            
            <!-- ==================== LEFT PANEL - CARTE PROFIL ==================== -->
            <aside class="space-y-6">
                
                <!-- CARTE DE PROFIL PRINCIPALE -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="h-24 bg-gradient-to-r from-[#0A2647] to-[#1E4A6D]"></div>
                    
                    <div class="relative px-6 pb-6">
                        <div class="flex justify-center -mt-12 mb-4">
                            <div class="relative">
                                <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0A2647&color=FFB703&size=120' }}"
                                     alt="Photo de profil"
                                     class="w-28 h-28 rounded-full object-cover border-4 border-white dark:border-gray-800 shadow-lg">
                                <div class="absolute bottom-0 right-0 w-5 h-5 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <h2 class="text-2xl font-bold text-[#0A2647] dark:text-white">{{ $user->name }}</h2>
                            <p class="text-[#FFB703] font-medium mt-1">{{ $user->professionnel->specialty->title ?? 'Professionnel certifié' }}</p>
                            <div class="flex items-center justify-center gap-2 mt-2 text-gray-500 dark:text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="text-sm">{{ $user->city ?? 'Ville non définie' }}</span>
                            </div>
                        </div>
                        
                        <!-- ==================== BOUTON CONSULTER - MODIFIÉ ==================== -->
                        <!-- Afficher uniquement pour les clients qui ne sont pas le propriétaire -->
                        @auth
                            @if(Auth::user()->client && Auth::id() !== $user->id)
                                <div class="mt-4">
                                    @if(isset($existingRequest) && $existingRequest)
                                        <div class="w-full text-center py-2.5 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                                            <span class="flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Demande envoyée - En attente de réponse
                                            </span>
                                        </div>
                                    @else
                                        <button onclick="openConsultationModal()" 
                                                class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-[#FFB703] to-[#FCD34D] hover:from-[#FDE047] hover:to-[#FFFBEB] text-[#0A2647] font-semibold py-2.5 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                            </svg>
                                            Envoyer une demande de consultation
                                        </button>
                                    @endif
                                </div>
                            @endif
                        @endauth
                        
                        <!-- Bouton Contacter -->
                        <div class="mt-3">
                            <a href="#" 
                               class="w-full flex items-center justify-center gap-2 border border-[#FFB703] text-[#FFB703] hover:bg-[#FFB703] hover:text-[#0A2647] font-semibold py-2.5 rounded-xl transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                Envoyer un message
                            </a>
                        </div>
                    </div>
                </div>

                <!-- STATISTIQUES RAPIDES -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-2.5 text-center">
                        <div class="text-xl font-bold text-[#0A2647] dark:text-white">{{ $posts->total() }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Publications</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-2.5 text-center">
                        <div class="text-xl font-bold text-[#0A2647] dark:text-white">{{ $consultationsCount ?? 0 }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Consultations</div>
                    </div>
                </div>

                <!-- CARTE CONTACT RAPIDE -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-5">
                    <div class="flex items-center gap-2 mb-4">
                        <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <h3 class="font-semibold text-gray-800 dark:text-white">Contact</h3>
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
                            <h3 class="font-semibold text-white">À propos du professionnel</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            {{ $user->professionnel->bio ?? 'Ce professionnel n\'a pas encore ajouté de description.' }}
                        </p>
                        
                        <div class="mt-6 grid sm:grid-cols-2 gap-4">
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                <div class="w-8 h-8 bg-[#FFB703]/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Catégorie</p>
                                    <p class="font-medium text-gray-800 dark:text-white">{{ $user->professionnel->category ?? 'Non défini' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                <div class="w-8 h-8 bg-[#FFB703]/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Spécialité</p>
                                    <p class="font-medium text-gray-800 dark:text-white">{{ $user->professionnel->specialty->title ?? 'Non défini' }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                                <div class="w-8 h-8 bg-[#FFB703]/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Ville</p>
                                    <p class="font-medium text-gray-800 dark:text-white">{{ $user->city ?? 'Non défini' }}</p>
                                </div>
                            </div>

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

                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl sm:col-span-2">
                                <div class="w-8 h-8 bg-[#FFB703]/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-4 h-4 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
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

                <!-- ==================== SECTION PUBLICATIONS ==================== -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-6 py-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                <h3 class="font-semibold text-white">Publications</h3>
                            </div>
                            <span class="text-xs text-[#FFB703]">{{ $posts->total() }} publications</span>
                        </div>
                    </div>
                    
                    <div class="p-5 space-y-5 max-h-[500px] overflow-y-auto custom-scrollbar">
                        
                        @forelse($posts as $post)
                        <div class="border-b border-gray-100 dark:border-gray-700 pb-5 last:border-0 last:pb-0">
                            <div class="flex items-center gap-3 mb-3">
                                <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0A2647&color=FFB703&size=40' }}"
                                     class="w-10 h-10 rounded-full object-cover">
                                <div>
                                    <h4 class="font-bold text-gray-800 dark:text-white">{{ $user->name }}</h4>
                                    <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-3 leading-relaxed">
                                {{ $post->description }}
                            </p>
                            @if($post->image)
                                <img src="{{ asset('storage/'.$post->image) }}" 
                                     class="rounded-xl mb-3 max-h-64 w-full object-cover cursor-pointer hover:opacity-90 transition"
                                     onclick="openImageModal('{{ asset('storage/'.$post->image) }}')">
                            @endif
                            <div class="flex gap-4 text-sm">
 
                                <button class="flex items-center gap-1 text-gray-500 hover:text-[#FFB703] transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <span>{{ $post->comments->count() }} commentaires</span>
                                </button>
                            </div>
                            
                            <!-- Afficher les commentaires -->
                            @if($post->comments->count() > 0)
                            <div class="mt-3 pt-2">
                                <button onclick="toggleComments({{ $post->id }})" class="text-xs text-[#FFB703] hover:underline">
                                    Voir les commentaires ({{ $post->comments->count() }})
                                </button>
                                <div id="comments-{{ $post->id }}" class="hidden mt-2 space-y-2">
                                    @foreach($post->comments as $comment)
                                    <div class="flex items-start gap-2 bg-gray-50 dark:bg-gray-700/50 p-2 rounded-lg">
                                        <img src="https://ui-avatars.com/api/?name={{ $comment->user->name }}&background=0A2647&color=FFB703&size=24" 
                                             class="w-6 h-6 rounded-full">
                                        <div class="flex-1">
                                            <span class="font-semibold text-gray-800 dark:text-white text-xs">{{ $comment->user->name }}</span>
                                            <p class="text-gray-600 dark:text-gray-300 text-xs">{{ $comment->content }}</p>
                                            <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400">Aucune publication pour le moment</p>
                        </div>
                        @endforelse
                        
                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

<!-- ==================== MODAL DEMANDE DE CONSULTATION ==================== -->
<div id="consultationModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-6 max-w-lg w-full mx-4 transform transition-all animate-modal">
        <div class="text-center mb-4">
            <div class="w-16 h-16 mx-auto mb-3 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Demande de consultation</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Envoyez une demande à <span class="font-semibold text-[#FFB703]">{{ $user->name }}</span></p>
        </div>
        
        <form method="POST" action="{{ route('sendConsultation',  $user->professionnel->id) }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Titre *</label>
                    <input type="text" name="title" required value="{{ old('title') }}"
                           class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition"
                           placeholder="Ex: Consultation médicale">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sujet *</label>
                    <input type="text" name="subject" required value="{{ old('subject') }}"
                           class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition"
                           placeholder="Ex: Problème de santé">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Message *</label>
                    <textarea name="message" rows="4" required
                              class="w-full px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none resize-none transition"
                              placeholder="Décrivez brièvement votre demande...">{{ old('message') }}</textarea>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeConsultationModal()"
                            class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        Annuler
                    </button>
                    <button type="submit"
                            class="flex-1 px-4 py-2 bg-gradient-to-r from-[#FFB703] to-[#FCD34D] text-[#0A2647] font-semibold rounded-xl hover:shadow-lg transition-all">
                        Envoyer la demande
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50" onclick="closeImageModal()">
    <img id="modalImage" class="max-w-[90%] max-h-[90%] rounded-lg shadow-2xl" src="">
</div>

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
    
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .animate-modal {
        animation: modalFadeIn 0.2s ease-out;
    }
</style>

<script>
    function openConsultationModal() {
        const modal = document.getElementById('consultationModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeConsultationModal() {
        const modal = document.getElementById('consultationModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }
    
    function openImageModal(imageUrl) {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('modalImage');
        img.src = imageUrl;
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
        if (commentsDiv) {
            commentsDiv.classList.toggle('hidden');
        }
    }
    
    // Fermer les modals en cliquant en dehors
    const consultationModal = document.getElementById('consultationModal');
    if (consultationModal) {
        consultationModal.addEventListener('click', function(e) {
            if (e.target === this) closeConsultationModal();
        });
    }
    
    const imageModal = document.getElementById('imageModal');
    if (imageModal) {
        imageModal.addEventListener('click', function(e) {
            if (e.target === this) closeImageModal();
        });
    }
    
    // Fermer avec la touche ECHAP
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const consultModal = document.getElementById('consultationModal');
            if (consultModal && !consultModal.classList.contains('hidden')) closeConsultationModal();
            const imgModal = document.getElementById('imageModal');
            if (imgModal && !imgModal.classList.contains('hidden')) closeImageModal();
        }
    });
</script>

@endsection