@extends('layouts.app')

@section('title', 'Connexion - ConnectPro')

@section('content')

<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#0A2647] via-[#1E4A6D] to-[#2C7DA0] py-12 px-4">
    <div class="w-full max-w-6xl">
        
        <!-- BADGE PRINCIPAL -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 mb-4">
                <span class="w-2 h-2 bg-[#FFB703] rounded-full animate-pulse"></span>
                <span class="text-white text-sm font-medium">Content de vous revoir</span>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            
            <!-- LEFT SIDE - ILLUSTRATION VECTORIELLE -->
            <div class="hidden md:flex flex-col justify-center">
                <div class="relative">
                    <!-- Cercles décoratifs -->
                    <div class="absolute -top-10 -left-10 w-32 h-32 bg-[#FFB703]/10 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-[#2C7DA0]/20 rounded-full blur-2xl"></div>
                    
                    <!-- Illustration SVG Connexion -->
                    <div class="relative bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400" class="w-full h-auto">
                            <!-- Cercle principal -->
                            <circle cx="200" cy="200" r="150" fill="none" stroke="#FFB703" stroke-width="1.5" stroke-dasharray="8 8"/>
                            <circle cx="200" cy="200" r="120" fill="none" stroke="#2C7DA0" stroke-width="1.5" stroke-dasharray="6 6"/>
                            
                            <!-- Personnage avec clé (connexion) -->
                            <circle cx="160" cy="180" r="30" fill="none" stroke="#FFB703" stroke-width="2.5"/>
                            <path d="M120 260 Q125 225 160 222 Q195 225 200 260" fill="#FFB703" opacity="0.8"/>
                            
                            <!-- Cadenas (sécurité) -->
                            <rect x="230" y="160" width="40" height="35" rx="5" fill="none" stroke="#2C7DA0" stroke-width="2.5"/>
                            <path d="M240 160 L240 145 Q240 130 250 130 Q260 130 260 145 L260 160" fill="none" stroke="#2C7DA0" stroke-width="2.5"/>
                            <circle cx="250" cy="175" r="3" fill="#2C7DA0"/>
                            
                            <!-- Flèche de connexion -->
                            <line x1="200" y1="220" x2="200" y2="280" stroke="#FFB703" stroke-width="2" stroke-dasharray="4 3"/>
                            <polygon points="195,275 200,290 205,275" fill="#FFB703"/>
                            
                            <!-- Clé -->
                            <circle cx="290" cy="250" r="12" fill="none" stroke="#FFB703" stroke-width="2"/>
                            <line x1="300" y1="260" x2="320" y2="280" stroke="#FFB703" stroke-width="2"/>
                            <circle cx="322" cy="282" r="3" fill="#FFB703"/>
                            
                            <!-- Étoiles/Sparkles décoratives -->
                            <circle cx="100" cy="120" r="3" fill="#FFB703" opacity="0.6"/>
                            <circle cx="300" cy="120" r="3" fill="#FFB703" opacity="0.6"/>
                            <circle cx="200" cy="100" r="2" fill="#2C7DA0" opacity="0.6"/>
                            <circle cx="130" cy="300" r="2" fill="#FFB703" opacity="0.4"/>
                            <circle cx="280" cy="320" r="2" fill="#FFB703" opacity="0.4"/>
                            
                            <!-- Points de connexion -->
                            <circle cx="200" cy="200" r="6" fill="#FFB703"/>
                            <circle cx="200" cy="200" r="3" fill="#0A2647"/>
                        </svg>
                    </div>
                    
                    <!-- Badge flottant 1 -->
                    <div class="absolute -top-5 -right-5 bg-white rounded-xl shadow-xl p-3 flex items-center gap-3 animate-bounce">
                        <div class="w-10 h-10 bg-[#FFB703] rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-[#0A2647]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V5h2v4z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Connexion</div>
                            <div class="font-bold text-[#0A2647]">100% sécurisée</div>
                        </div>
                    </div>
                    
                    <!-- Badge flottant 2 -->
                    <div class="absolute -bottom-5 -left-5 bg-[#FFB703] rounded-xl shadow-xl p-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#0A2647]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12H2v-2h7V3h2v7h7v2h-7v7H9v-7z"/>
                            </svg>
                            <span class="text-[#0A2647] font-semibold">Accès rapide</span>
                        </div>
                    </div>
                </div>
                
                <!-- Liste des avantages de la connexion -->
                <div class="mt-8 space-y-4">
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-6 h-6 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-[#FFB703]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span>Accès à tous vos services</span>
                    </div>
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-6 h-6 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-[#FFB703]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 0 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span>Gérez vos consultations</span>
                    </div>
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-6 h-6 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-[#FFB703]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 0 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span>Messagerie instantanée</span>
                    </div>
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-6 h-6 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-[#FFB703]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 0 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span>Support prioritaire</span>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE - FORMULAIRE DE CONNEXION -->
            <div class="flex items-center justify-center">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 w-full max-w-md">
                    
                    <!-- En-tête du formulaire -->
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-[#FFB703]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-[#0A2647] dark:text-white">Bon retour parmi nous</h2>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Connectez-vous à votre compte</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <!-- EMAIL -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Adresse email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input type="email" name="email" placeholder="jean.dupont@email.com" value="{{ old('email') }}" required autofocus
                                       class="w-full pl-10 p-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition">
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- MOT DE PASSE -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mot de passe</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input type="password" name="password" placeholder="••••••••" required
                                       class="w-full pl-10 p-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition">
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- OPTIONS (Remember + Forgot) -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="remember" class="w-4 h-4 text-[#FFB703] rounded border-gray-300 focus:ring-[#FFB703]">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Se souvenir de moi</span>
                            </label>
                            <a href="{{ route('password.request') }}" class="text-sm text-[#FFB703] hover:text-[#E5A500] font-medium transition">
                                Mot de passe oublié ?
                            </a>
                        </div>

                        <!-- BOUTON CONNEXION -->
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] hover:from-[#1E4A6D] hover:to-[#2C7DA0] text-white font-bold py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                            🔐 Se connecter
                        </button>

                    </form>

                    <!-- SÉPARATEUR -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">ou</span>
                        </div>
                    </div>



                    <!-- LIEN INSCRIPTION -->
                    <p class="text-center text-gray-600 dark:text-gray-400">
                        Pas encore de compte ?
                        <a href="{{ route('register') }}" class="text-[#FFB703] font-semibold hover:text-[#E5A500] transition">
                            Créer un compte
                        </a>
                    </p>

                    <!-- MESSAGE DE SÉCURITÉ -->
                    <div class="mt-4 flex items-center justify-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Connexion sécurisée - Vos données sont protégées</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection