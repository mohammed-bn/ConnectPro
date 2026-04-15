@extends('layouts.app')

@section('title', 'Accueil - ConnectPro')

@section('content')

<!-- HERO SECTION AVEC PHOTO PROFESSIONNELLE -->
<section class="relative overflow-hidden bg-gradient-to-br from-[#0A2647] via-[#1E4A6D] to-[#2C7DA0]">
    <div class="container mx-auto px-6 py-16 lg:py-20">
        <div class="flex flex-col lg:flex-row items-center gap-12">
            
            <!-- TEXTE -->
            <div class="flex-1 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-1.5 mb-6">
                    <span class="w-2 h-2 bg-[#FFB703] rounded-full animate-pulse"></span>
                    <span class="text-white/90 text-sm font-medium">Plateforme certifiée</span>
                </div>
                
                <h1 class="text-4xl lg:text-6xl font-extrabold text-white mb-6 leading-tight">
                    Trouvez le professionnel
                    <span class="text-[#FFB703]">idéal</span>
                    près de chez vous
                </h1>
                
                <p class="text-lg text-white/80 mb-8 max-w-xl mx-auto lg:mx-0">
                    Connectez-vous aux meilleurs professionnels qualifiés. Simple, rapide et 100% fiable.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('register') }}" 
                       class="bg-[#FFB703] hover:bg-[#E5A500] text-[#0A2647] font-bold px-8 py-3.5 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg text-center">
                        🚀 S'inscrire gratuitement
                    </a>
                    <a href="#services" 
                       class="border-2 border-white/30 hover:border-[#FFB703] text-white font-semibold px-8 py-3.5 rounded-xl transition-all duration-300 text-center">
                        Découvrir la plateforme
                    </a>
                </div>
                
                <!-- STATS -->
                <div class="flex flex-wrap gap-8 justify-center lg:justify-start mt-10 pt-6 border-t border-white/20">
                    <div>
                        <div class="text-2xl font-bold text-[#FFB703]">500+</div>
                        <div class="text-sm text-white/70">Professionnels</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-[#FFB703]">1 200+</div>
                        <div class="text-sm text-white/70">Clients satisfaits</div>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-[#FFB703]">50+</div>
                        <div class="text-sm text-white/70">Villes couvertes</div>
                    </div>
                </div>
            </div>
            
            <!-- PHOTO PROFESSIONNELLE -->
            <div class="flex-1 relative">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=600&fit=crop" 
                         alt="Professionnels en réunion"
                         class="w-full h-auto object-cover transform hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0A2647]/50 to-transparent"></div>
                </div>
                <!-- Badge flottant -->
                <div class="absolute -bottom-5 -left-5 bg-white dark:bg-gray-800 rounded-xl shadow-xl p-3 flex items-center gap-3">
                                    <div class="w-10 h-10 bg-[#FFB703] rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-[#0A2647]" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12H2v-2h7V3h2v7h7v2h-7v7H9v-7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Mise en relation</div>
                                        <div class="font-bold text-[#0A2647] dark:text-white">100% gratuite</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

<!-- SECTION SERVICES AVEC PHOTOS -->
<section id="services" class="py-20 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-[#FFB703] font-semibold uppercase tracking-wide">Nos services</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-[#0A2647] dark:text-white mt-2 mb-4">
                Une plateforme complète
            </h2>
            <p class="text-gray-600 dark:text-gray-400">
                Découvrez tous les outils mis à votre disposition pour faciliter vos recherches et consultations.
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Carte 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 group">
                <div class="h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=300&fit=crop" 
                         alt="Recherche de professionnels"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <div class="p-5">
                    <div class="w-10 h-10 bg-[#FFB703]/20 rounded-lg flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-[#0A2647] dark:text-white mb-2">Recherche intelligente</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Trouvez des professionnels par mot-clé, localisation et spécialité.</p>
                </div>
            </div>
            
            <!-- Carte 2 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 group">
                <div class="h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?w=400&h=300&fit=crop" 
                         alt="Consultation en ligne"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <div class="p-5">
                    <div class="w-10 h-10 bg-[#FFB703]/20 rounded-lg flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-[#0A2647] dark:text-white mb-2">Consultation en ligne</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Échangez facilement avec les professionnels via notre messagerie.</p>
                </div>
            </div>
            
            <!-- Carte 3 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 group">
                <div class="h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?w=400&h=300&fit=crop" 
                         alt="Messagerie instantanée"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <div class="p-5">
                    <div class="w-10 h-10 bg-[#FFB703]/20 rounded-lg flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-[#0A2647] dark:text-white mb-2">Messagerie instantanée</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Communication en temps réel avec les professionnels.</p>
                </div>
            </div>
            
            <!-- Carte 4 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 group">
                <div class="h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1581091226033-d5c48150dbaa?w=400&h=300&fit=crop" 
                         alt="Gestion de profil"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <div class="p-5">
                    <div class="w-10 h-10 bg-[#FFB703]/20 rounded-lg flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg text-[#0A2647] dark:text-white mb-2">Gestion de profil</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Créez et gérez votre profil professionnel facilement.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION COMMENT ÇA MARCHE -->
<section class="py-20 bg-white dark:bg-gray-800">
    <div class="container mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-[#FFB703] font-semibold uppercase tracking-wide">Processus simple</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-[#0A2647] dark:text-white mt-2 mb-4">
                Comment ça marche ?
            </h2>
            <p class="text-gray-600 dark:text-gray-400">
                ️3 étapes simples pour trouver le professionnel qu'il vous faut.
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Étape 1 -->
            <div class="text-center group">
                <div class="w-24 h-24 bg-[#FFB703]/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#FFB703]/20 transition">
                    <span class="text-3xl font-bold text-[#FFB703]">1</span>
                </div>
                <div class="relative">
                    <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-[#FFB703]/20 -z-10"></div>
                </div>
                <h3 class="font-bold text-xl text-[#0A2647] dark:text-white mb-2">Créez un compte</h3>
                <p class="text-gray-600 dark:text-gray-400">Inscrivez-vous gratuitement en quelques clics.</p>
            </div>
            
            <!-- Étape 2 -->
            <div class="text-center group">
                <div class="w-24 h-24 bg-[#FFB703]/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#FFB703]/20 transition">
                    <span class="text-3xl font-bold text-[#FFB703]">2</span>
                </div>
                <div class="relative">
                    <div class="hidden md:block absolute top-10 left-full w-full h-0.5 bg-[#FFB703]/20 -z-10"></div>
                </div>
                <h3 class="font-bold text-xl text-[#0A2647] dark:text-white mb-2">Recherchez</h3>
                <p class="text-gray-600 dark:text-gray-400">Trouvez le professionnel idéal par mots-clés et localisation.</p>
            </div>
            
            <!-- Étape 3 -->
            <div class="text-center group">
                <div class="w-24 h-24 bg-[#FFB703]/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-[#FFB703]/20 transition">
                    <span class="text-3xl font-bold text-[#FFB703]">3</span>
                </div>
                <h3 class="font-bold text-xl text-[#0A2647] dark:text-white mb-2">Connectez-vous</h3>
                <p class="text-gray-600 dark:text-gray-400">Envoyez une demande et communiquez directement.</p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION TÉMOIGNAGES AVEC PHOTOS -->
<section class="py-20 bg-gray-50 dark:bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-[#FFB703] font-semibold uppercase tracking-wide">Témoignages</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-[#0A2647] dark:text-white mt-2 mb-4">
                Ce qu'ils disent de nous
            </h2>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Témoignage 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition">
                <div class="flex items-center gap-4 mb-4">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" 
                         alt="Client"
                         class="w-14 h-14 rounded-full object-cover">
                    <div>
                        <h4 class="font-bold text-[#0A2647] dark:text-white">Sophie Martin</h4>
                        <div class="flex text-[#FFB703] text-sm">★★★★★</div>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-400 italic">
                    "J'ai trouvé un avocat compétent en moins de 24h. La plateforme est très intuitive !"
                </p>
            </div>
            
            <!-- Témoignage 2 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition">
                <div class="flex items-center gap-4 mb-4">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" 
                         alt="Professionnel"
                         class="w-14 h-14 rounded-full object-cover">
                    <div>
                        <h4 class="font-bold text-[#0A2647] dark:text-white">Dr. Thomas Bernard</h4>
                        <div class="flex text-[#FFB703] text-sm">★★★★★</div>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-400 italic">
                    "ConnectPro m'a permis de développer ma patientèle. Je recommande vivement !"
                </p>
            </div>
            
            <!-- Témoignage 3 -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl transition">
                <div class="flex items-center gap-4 mb-4">
                    <img src="https://randomuser.me/api/portraits/women/45.jpg" 
                         alt="Client"
                         class="w-14 h-14 rounded-full object-cover">
                    <div>
                        <h4 class="font-bold text-[#0A2647] dark:text-white">Marie Dubois</h4>
                        <div class="flex text-[#FFB703] text-sm">★★★★★</div>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-400 italic">
                    "Service client réactif et professionnels de qualité. Une excellente initiative !"
                </p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION CTA FINALE -->
<section class="py-16 bg-gradient-to-r from-[#0A2647] to-[#1E4A6D]">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
            Prêt à rejoindre l'aventure ?
        </h2>
        <p class="text-white/80 mb-8 max-w-xl mx-auto">
            Inscrivez-vous gratuitement et commencez à connecter avec les meilleurs professionnels.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" 
               class="bg-[#FFB703] hover:bg-[#E5A500] text-[#0A2647] font-bold px-8 py-3.5 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                🚀 S'inscrire maintenant
            </a>
            <a href="#" 
               class="border-2 border-white/30 hover:border-[#FFB703] text-white font-semibold px-8 py-3.5 rounded-xl transition-all duration-300">
                📞 Contacter le support
            </a>
        </div>
    </div>
</section>

@endsection