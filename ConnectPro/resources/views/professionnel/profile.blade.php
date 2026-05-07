@extends('layouts.app')

@section('title', 'Profil Professionnel - ConnectPro')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-8">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Messages Flash -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-r-lg animate-pulse">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-r-lg">
                {{ session('error') }}
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
                        
                        <div class="mt-4">
                            <a href="{{ route('profilePrEdit') }}" 
                               class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] hover:from-[#1E4A6D] hover:to-[#2C7DA0] text-white font-semibold py-2.5 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                Modifier mon profil
                            </a>
                        </div>
                    </div>
                </div>

                <!-- STATISTIQUES RAPIDES DYNAMIQUES -->
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-3 text-center hover:shadow-lg transition">
                        <div class="text-2xl font-bold text-[#0A2647] dark:text-white" id="totalPostsCount">{{ $totalPosts }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Publications</div>
                        <div class="mt-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full h-1">
                            <div class="bg-[#FFB703] h-1 rounded-full transition-all duration-500" style="width: {{ min(100, ($totalPosts / max(1, $totalPosts)) * 100) }}%"></div>
                        </div>
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
                            <h3 class="font-semibold text-white">À propos de moi</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            {{ $user->professionnel->bio ?? 'Aucune description pour le moment. Cliquez sur "Modifier mon profil" pour ajouter une présentation.' }}
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
                        </div>
                    </div>
                </div>

                <!-- SECTION CRÉATION RAPIDE DE PUBLICATION -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-6 py-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <h3 class="font-semibold text-white">Publier quelque chose</h3>
                        </div>
                    </div>
                    <div class="p-5">
                        <form id="quickPostForm" method="POST" action="{{ route('addPost') }}" enctype="multipart/form-data">
                            @csrf
                            <textarea name="description" id="postDescription" rows="3"
                                      placeholder="Partagez une idée, un service, une actualité..."
                                      class="w-full p-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-xl focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition resize-none text-sm"></textarea>
                            
                            <div class="flex items-center justify-between mt-3">
                                <div class="flex items-center gap-3">
                                    <label for="postImage" class="cursor-pointer px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center gap-2 text-sm">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span>Photo</span>
                                    </label>
                                    <input type="file" name="image" id="postImage" accept="image/*" class="hidden">
                                    <span id="fileName" class="text-xs text-gray-500"></span>
                                </div>
                                <button type="submit"
                                        class="px-6 py-2 bg-gradient-to-r from-[#FFB703] to-[#FCD34D] text-[#0A2647] font-semibold rounded-xl hover:shadow-lg transition-all transform hover:scale-105 flex items-center gap-2 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Publier
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- SECTION PUBLICATIONS DYNAMIQUE -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-6 py-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                <h3 class="font-semibold text-white">Mes publications</h3>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-[#FFB703]" id="postsCount">{{ $totalPosts }} publications</span>
                                <button onclick="refreshPosts()" class="text-white/70 hover:text-white transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div id="postsContainer" class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($posts as $post)
                        <div class="p-5 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition post-item" data-post-id="{{ $post->id }}">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0A2647&color=FFB703&size=40' }}"
                                         class="w-10 h-10 rounded-full object-cover">
                                    <div>
                                        <h4 class="font-bold text-gray-800 dark:text-white">{{ $user->name }}</h4>
                                        <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <!-- Bouton supprimer -->
                                    <button onclick="deletePost({{ $post->id }})" 
                                            class="text-gray-400 hover:text-red-500 transition p-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <p class="text-gray-700 dark:text-gray-300 mb-3 leading-relaxed">
                                {{ $post->description }}
                            </p>
                            
                            @if($post->image)
                            <div class="mb-3 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/'.$post->image) }}" 
                                     class="w-full max-h-80 object-cover rounded-lg cursor-pointer"
                                     onclick="showImageModal('{{ asset('storage/'.$post->image) }}')">
                            </div>
                            @endif
                            
                            <div class="flex items-center gap-5 mb-3">
                                <button onclick="toggleLike({{ $post->id }}, this)" 
                                        class="flex items-center gap-1.5 text-gray-500 hover:text-red-500 transition text-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                    <span class="like-count-{{ $post->id }}">{{ $post->likes_count ?? 0 }}</span>
                                </button>
                                <button onclick="toggleCommentSection({{ $post->id }})" 
                                        class="flex items-center gap-1.5 text-gray-500 hover:text-[#FFB703] transition text-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <span class="comment-count-{{ $post->id }}">{{ $post->comments->count() }}</span>
                                </button>
                            </div>
                            
                            <!-- Section commentaires -->
                            <div id="commentSection-{{ $post->id }}" class="hidden mt-3 pt-3 border-t border-gray-100 dark:border-gray-700">
                                <div class="space-y-3 mb-3 max-h-40 overflow-y-auto" id="commentsList-{{ $post->id }}">
                                    @foreach($post->comments as $comment)
                                    <div class="flex items-start gap-2">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=0A2647&color=FFB703&size=24" 
                                             class="w-6 h-6 rounded-full">
                                        <div class="flex-1">
                                            <span class="font-semibold text-xs text-gray-800 dark:text-white">{{ $comment->user->name }}</span>
                                            <p class="text-xs text-gray-600 dark:text-gray-400">{{ $comment->content }}</p>
                                            <p class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <form class="comment-form" data-post-id="{{ $post->id }}" onsubmit="event.preventDefault(); addComment(this)">
                                    @csrf
                                    <div class="flex gap-2">
                                        <input type="text" name="content" placeholder="Ajouter un commentaire..." 
                                               class="flex-1 p-2 text-sm border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none">
                                        <button type="submit" class="px-3 py-1 bg-[#FFB703] text-[#0A2647] text-sm rounded-lg hover:bg-[#E5A500] transition">
                                            Envoyer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div id="emptyPostsState" class="p-12 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400">Aucune publication pour le moment</p>
                            <p class="text-sm text-gray-400 mt-2">Commencez à partager votre expertise !</p>
                        </div>
                        @endforelse
                    </div>
                    
                    <!-- Pagination -->
                    <div class="px-5 py-4 border-t border-gray-100 dark:border-gray-700">
                        {{ $posts->links() }}
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

<!-- Modal pour les images -->
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
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .post-item {
        animation: fadeIn 0.3s ease-out;
    }
</style>

<script>
    // Configuration AJAX
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    
    // Calcul et mise à jour des statistiques
    function updateStats() {
        let totalLikes = 0;
        let totalComments = 0;
        let postCount = {{ $totalPosts }};
        
        document.querySelectorAll('.like-count-{{ $user->id }}, .like-count').forEach(el => {
            totalLikes += parseInt(el.textContent) || 0;
        });
        
        document.querySelectorAll('.comment-count-{{ $user->id }}, .comment-count').forEach(el => {
            totalComments += parseInt(el.textContent) || 0;
        });
        
        $('#totalLikesCount').text(totalLikes);
        $('#totalCommentsCount').text(totalComments);
        
        let avgLikes = postCount > 0 ? (totalLikes / postCount).toFixed(1) : 0;
        $('#avgLikesPerPost').text(avgLikes);
        
        let engagementRate = postCount > 0 ? ((totalLikes + totalComments) / postCount).toFixed(1) : 0;
        $('#engagementRate').text(engagementRate + '%');
        
        let lastPostDateEl = document.getElementById('lastPostDate');
        if (lastPostDateEl && document.querySelector('.post-item')) {
            let lastDate = document.querySelector('.post-item .text-xs.text-gray-500')?.textContent;
            lastPostDateEl.textContent = lastDate || '-';
        }
    }
    
    // Rafraîchir les publications
    function refreshPosts() {
        $('#postsContainer').html('<div class="p-12 text-center"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-[#FFB703] mx-auto"></div><p class="mt-4 text-gray-500">Chargement...</p></div>');
        
        $.ajax({
            url: '{{ route("profilePr") }}?ajax=1',
            type: 'GET',
            success: function(response) {
                if (response.html) {
                    $('#postsContainer').html(response.html);
                    updateStats();
                } else {
                    location.reload();
                }
            },
            error: function() {
                location.reload();
            }
        });
    }
    
    // Ajouter une publication
    $('#quickPostForm').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        
        $.ajax({
            url: this.action,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    let newPost = `
                        <div class="p-5 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition post-item" data-post-id="${response.post.id}">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0A2647&color=FFB703&size=40' }}" class="w-10 h-10 rounded-full object-cover">
                                    <div>
                                        <h4 class="font-bold text-gray-800 dark:text-white">{{ $user->name }}</h4>
                                        <p class="text-xs text-gray-500">À l'instant</p>
                                    </div>
                                </div>
                                <button onclick="deletePost(${response.post.id})"
                                    class="text-gray-400 hover:text-red-500 transition p-1">
                                </button>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300 mb-3 leading-relaxed">${response.post.description}</p>
                            ${response.post.image ? `<div class="mb-3 rounded-lg overflow-hidden"><img src="${response.post.image_url}" class="w-full max-h-80 object-cover rounded-lg cursor-pointer" onclick="showImageModal('${response.post.image_url}')"></div>` : ''}
                            <div class="flex items-center gap-5">
                                <button onclick="toggleLike(${response.post.id}, this)" class="flex items-center gap-1.5 text-gray-500 hover:text-red-500 transition text-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                    <span class="like-count-${response.post.id}">0</span>
                                </button>
                                <button onclick="toggleCommentSection(${response.post.id})" class="flex items-center gap-1.5 text-gray-500 hover:text-[#FFB703] transition text-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                    <span class="comment-count-${response.post.id}">0</span>
                                </button>
                            </div>
                            <div id="commentSection-${response.post.id}" class="hidden mt-3 pt-3 border-t border-gray-100 dark:border-gray-700">
                                <div class="space-y-3 mb-3 max-h-40 overflow-y-auto" id="commentsList-${response.post.id}"></div>
                                <form class="comment-form" data-post-id="${response.post.id}" onsubmit="event.preventDefault(); addComment(this)">
                                    @csrf
                                    <div class="flex gap-2">
                                        <input type="text" name="content" placeholder="Ajouter un commentaire..." class="flex-1 p-2 text-sm border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none">
                                        <button type="submit" class="px-3 py-1 bg-[#FFB703] text-[#0A2647] text-sm rounded-lg hover:bg-[#E5A500] transition">Envoyer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    `;
                    
                    if ($('#emptyPostsState').length) {
                        $('#postsContainer').html(newPost);
                        $('#emptyPostsState').remove();
                    } else {
                        $('#postsContainer').prepend(newPost);
                    }
                    
                    $('#postDescription').val('');
                    $('#fileName').text('');
                    $('#totalPostsCount').text(parseInt($('#totalPostsCount').text()) + 1);
                    $('#postsCount').text(parseInt($('#totalPostsCount').text()) + ' publications');
                    
                    showNotification('Publication ajoutée avec succès !', 'success');
                    updateStats();
                }
            },
            error: function(xhr) {
                showNotification('Erreur lors de l\'ajout', 'error');
            }
        });
    });
    
    // Supprimer une publication
    function deletePost(postId) {
        if (!confirm('Voulez-vous vraiment supprimer cette publication ?')) return;
        
        $.ajax({
            url: `/post/${postId}`,
            type: 'DELETE',
            success: function(response) {
                if (response.success) {
                    $(`.post-item[data-post-id="${postId}"]`).fadeOut(300, function() { $(this).remove(); });
                    let newCount = parseInt($('#totalPostsCount').text()) - 1;
                    $('#totalPostsCount').text(newCount);
                    $('#postsCount').text(newCount + ' publications');
                    showNotification('Publication supprimée', 'success');
                    updateStats();
                }
            },
            error: function() {
                showNotification('Erreur lors de la suppression', 'error');
            }
        });
    }
    
    // Ajouter un commentaire
    function addComment(form) {
        let postId = $(form).data('post-id');
        let content = $(form).find('input[name="content"]').val();
        if (!content.trim()) return;
        
        $.ajax({
            url: `/post/${postId}/comment`,
            type: 'POST',
            data: { content: content },
            success: function(response) {
                if (response.success) {
                    let commentHtml = `
                        <div class="flex items-start gap-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0A2647&color=FFB703&size=24" class="w-6 h-6 rounded-full">
                            <div class="flex-1">
                                <span class="font-semibold text-xs text-gray-800 dark:text-white">{{ Auth::user()->name }}</span>
                                <p class="text-xs text-gray-600 dark:text-gray-400">${content}</p>
                                <p class="text-xs text-gray-400">À l'instant</p>
                            </div>
                        </div>
                    `;
                    $(`#commentsList-${postId}`).append(commentHtml);
                    $(form).find('input[name="content"]').val('');
                    
                    let count = parseInt($(`.comment-count-${postId}`).text()) + 1;
                    $(`.comment-count-${postId}`).text(count);
                    showNotification('Commentaire ajouté', 'success');
                    updateStats();
                }
            },
            error: function() {
                showNotification('Erreur lors de l\'ajout du commentaire', 'error');
            }
        });
    }
    
    
    // Toggle comment section
    function toggleCommentSection(postId) {
        $(`#commentSection-${postId}`).toggleClass('hidden');
    }
    
    // Image modal
    function showImageModal(imageUrl) {
        $('#modalImage').attr('src', imageUrl);
        $('#imageModal').removeClass('hidden').addClass('flex');
        $('body').css('overflow', 'hidden');
    }
    
    function closeImageModal() {
        $('#imageModal').addClass('hidden').removeClass('flex');
        $('body').css('overflow', '');
    }
    
    // Notification
    function showNotification(message, type = 'success') {
        let bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        let notification = $(`
            <div class="fixed top-20 right-4 z-50 animate-pulse">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-4 max-w-sm border-l-4 ${bgColor}">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 ${bgColor}/20 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-${type === 'success' ? 'green' : 'red'}-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 dark:text-white">Notification</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">${message}</p>
                        </div>
                        <button onclick="$(this).closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">✕</button>
                    </div>
                </div>
            </div>
        `);
        $('body').append(notification);
        setTimeout(() => notification.fadeOut(300, function() { $(this).remove(); }), 3000);
    }
    
    // File input handler
    $('#postImage').on('change', function() {
        $('#fileName').text(this.files[0] ? this.files[0].name : '');
    });
    
    // Initialisation
    $(document).ready(function() {
        updateStats();
        
        // ESC to close modal
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') closeImageModal();
        });
    });
</script>

@endsection