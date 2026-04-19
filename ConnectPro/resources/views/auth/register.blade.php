@extends('layouts.app')

@section('title', 'Inscription - ConnectPro')

@section('content')

<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#0A2647] via-[#1E4A6D] to-[#2C7DA0] py-12 px-4">
    <div class="w-full max-w-6xl">
        
        <!-- BADGE PRINCIPAL -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 mb-4">
                <span class="w-2 h-2 bg-[#FFB703] rounded-full animate-pulse"></span>
                <span class="text-white text-sm font-medium">Rejoignez la communauté ConnectPro</span>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            
            <!-- LEFT SIDE - ILLUSTRATION VECTORIELLE -->
            <div class="hidden md:flex flex-col justify-center">
                <div class="relative">
                    <!-- Cercle décoratif -->
                    <div class="absolute -top-10 -left-10 w-32 h-32 bg-[#FFB703]/10 rounded-full blur-2xl"></div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-[#2C7DA0]/20 rounded-full blur-2xl"></div>
                    
                    <!-- Illustration SVG -->
                    <div class="relative bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400" class="w-full h-auto">
                            <circle cx="200" cy="200" r="150" fill="none" stroke="#FFB703" stroke-width="1.5" stroke-dasharray="8 8"/>
                            <circle cx="200" cy="200" r="120" fill="none" stroke="#2C7DA0" stroke-width="1.5" stroke-dasharray="6 6"/>
                            <circle cx="130" cy="160" r="25" fill="none" stroke="#FFB703" stroke-width="2.5"/>
                            <path d="M95 220 Q100 195 130 192 Q160 195 165 220" fill="#FFB703" opacity="0.8"/>
                            <circle cx="270" cy="160" r="25" fill="none" stroke="#FFB703" stroke-width="2.5"/>
                            <path d="M235 220 Q240 195 270 192 Q300 195 305 220" fill="#FFB703" opacity="0.8"/>
                            <circle cx="200" cy="250" r="30" fill="none" stroke="#2C7DA0" stroke-width="3"/>
                            <path d="M160 320 Q165 290 200 287 Q235 290 240 320" fill="#2C7DA0" opacity="0.9"/>
                            <line x1="155" y1="170" x2="185" y2="240" stroke="#FFB703" stroke-width="2" stroke-dasharray="4 3"/>
                            <line x1="245" y1="170" x2="215" y2="240" stroke="#FFB703" stroke-width="2" stroke-dasharray="4 3"/>
                            <circle cx="200" cy="200" r="8" fill="#FFB703"/>
                            <circle cx="200" cy="200" r="4" fill="#0A2647"/>
                            <circle cx="90" cy="100" r="3" fill="#FFB703" opacity="0.6"/>
                            <circle cx="310" cy="100" r="3" fill="#FFB703" opacity="0.6"/>
                            <circle cx="200" cy="120" r="2" fill="#2C7DA0" opacity="0.6"/>
                            <circle cx="150" cy="300" r="2" fill="#FFB703" opacity="0.4"/>
                            <circle cx="250" cy="300" r="2" fill="#FFB703" opacity="0.4"/>
                        </svg>
                    </div>
                    
                    <!-- Badge flottant 1 -->
                    <div class="absolute -top-5 -right-5 bg-white rounded-xl shadow-xl p-3 flex items-center gap-3 animate-bounce">
                        <div class="w-10 h-10 bg-[#FFB703] rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-[#0A2647]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12H2v-2h7V3h2v7h7v2h-7v7H9v-7z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500">Inscription</div>
                            <div class="font-bold text-[#0A2647]">100% gratuite</div>
                        </div>
                    </div>
                    
                    <!-- Badge flottant 2 -->
                    <div class="absolute -bottom-5 -left-5 bg-[#FFB703] rounded-xl shadow-xl p-3">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#0A2647]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V5h2v4z"/>
                            </svg>
                            <span class="text-[#0A2647] font-semibold">+500 professionnels</span>
                        </div>
                    </div>
                </div>
                
                <!-- Liste d'avantages -->
                <div class="mt-8 space-y-4">
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-6 h-6 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-[#FFB703]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span>Accès à tous les professionnels</span>
                    </div>
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-6 h-6 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-[#FFB703]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 0 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span>Messagerie instantanée incluse</span>
                    </div>
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-6 h-6 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-[#FFB703]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 0 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span>Support client 7j/7</span>
                    </div>
                    <div class="flex items-center gap-3 text-white">
                        <div class="w-6 h-6 bg-[#FFB703]/20 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-[#FFB703]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 0 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span>Certification des professionnels</span>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE - FORMULAIRE D'INSCRIPTION -->
            <div class="flex items-center justify-center">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 w-full max-w-md">
                    
                    <!-- En-tête du formulaire -->
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 bg-[#FFB703]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-[#0A2647] dark:text-white">Créez votre compte</h2>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Rejoignez gratuitement la communauté</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-4">
                        @csrf

                        <!-- NOM COMPLET -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom complet</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input type="text" name="name" placeholder="Jean Dupont" value="{{ old('name') }}" required
                                       class="w-full pl-10 p-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition">
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- EMAIL -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Adresse email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input type="email" name="email" placeholder="jean.dupont@email.com" value="{{ old('email') }}" required
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

                        <!-- CONFIRMER MOT DE PASSE -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirmer le mot de passe</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input type="password" name="password_confirmation" placeholder="••••••••" required
                                       class="w-full pl-10 p-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition">
                            </div>
                        </div>

                        <!-- ==================== -->
                        <!-- SECTION LOCALISATION -->
                        <!-- ==================== -->
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-2">
                            <div class="flex items-center gap-2 mb-3">
                                <svg class="w-5 h-5 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">Votre localisation</label>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <!-- RÉGION (SELECT) -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Région</label>
                                    <select id="region" name="region" 
                                        class="w-full p-2.5 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition text-sm">
                                        <option value="">-- Choisir une région --</option>
                                        <option value="Tanger-Tétouan-Al Hoceima" {{ old('region') == 'Tanger-Tétouan-Al Hoceima' ? 'selected' : '' }}>Tanger-Tétouan-Al Hoceima</option>
                                        <option value="L'Oriental" {{ old('region') == "L'Oriental" ? 'selected' : '' }}>L'Oriental</option>
                                        <option value="Fès-Meknès" {{ old('region') == 'Fès-Meknès' ? 'selected' : '' }}>Fès-Meknès</option>
                                        <option value="Rabat-Salé-Kénitra" {{ old('region') == 'Rabat-Salé-Kénitra' ? 'selected' : '' }}>Rabat-Salé-Kénitra</option>
                                        <option value="Béni Mellal-Khénifra" {{ old('region') == 'Béni Mellal-Khénifra' ? 'selected' : '' }}>Béni Mellal-Khénifra</option>
                                        <option value="Casablanca-Settat" {{ old('region') == 'Casablanca-Settat' ? 'selected' : '' }}>Casablanca-Settat</option>
                                        <option value="Marrakech-Safi" {{ old('region') == 'Marrakech-Safi' ? 'selected' : '' }}>Marrakech-Safi</option>
                                        <option value="Drâa-Tafilalet" {{ old('region') == 'Drâa-Tafilalet' ? 'selected' : '' }}>Drâa-Tafilalet</option>
                                        <option value="Souss-Massa" {{ old('region') == 'Souss-Massa' ? 'selected' : '' }}>Souss-Massa</option>
                                        <option value="Guelmim-Oued Noun" {{ old('region') == 'Guelmim-Oued Noun' ? 'selected' : '' }}>Guelmim-Oued Noun</option>
                                        <option value="Laâyoune-Sakia El Hamra" {{ old('region') == 'Laâyoune-Sakia El Hamra' ? 'selected' : '' }}>Laâyoune-Sakia El Hamra</option>
                                        <option value="Dakhla-Oued Ed-Dahab" {{ old('region') == 'Dakhla-Oued Ed-Dahab' ? 'selected' : '' }}>Dakhla-Oued Ed-Dahab</option>
                                    </select>
                                    @error('region')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- VILLE (SELECT DYNAMIQUE) -->
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Ville</label>
                                    <select id="city" name="city" 
                                        class="w-full p-2.5 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition text-sm">
                                        <option value="">-- Choisir une ville --</option>
                                    </select>
                                    @error('city')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- ADRESSE COMPLÈTE -->
                            <div class="mt-3">
                                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Adresse complète</label>
                                <textarea name="address" rows="2" placeholder="Numéro, rue, code postal..."
                                          class="w-full p-2.5 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition text-sm resize-none">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- TYPE DE COMPTE -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Je suis :</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="flex items-center justify-center gap-2 p-2 border border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <input type="radio" name="role" value="utilisateur" checked class="text-[#FFB703] focus:ring-[#FFB703]">
                                    <span class="text-sm">👤 Utilisateur</span>
                                </label>
                                <label class="flex items-center justify-center gap-2 p-2 border border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <input type="radio" name="role" value="professional" class="text-[#FFB703] focus:ring-[#FFB703]">
                                    <span class="text-sm">💼 Professionnel</span>
                                </label>
                            </div>
                        </div>

                        <!-- CONDITIONS -->
                        <div class="flex items-start gap-2">
                            <input type="checkbox" name="terms" id="terms" required
                                   class="mt-1 w-4 h-4 text-[#FFB703] rounded border-gray-300 focus:ring-[#FFB703]">
                            <label for="terms" class="text-xs text-gray-600 dark:text-gray-400">
                                J'accepte les <a href="#" class="text-[#FFB703] hover:underline">conditions d'utilisation</a> et la 
                                <a href="#" class="text-[#FFB703] hover:underline">politique de confidentialité</a>
                            </label>
                        </div>

                        <!-- BOUTON INSCRIPTION -->
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] hover:from-[#1E4A6D] hover:to-[#2C7DA0] text-white font-bold py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                            🚀 S'inscrire gratuitement
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

                    <!-- LIEN CONNEXION -->
                    <p class="text-center text-gray-600 dark:text-gray-400">
                        Déjà un compte ?
                        <a href="{{ route('login') }}" class="text-[#FFB703] font-semibold hover:text-[#E5A500] transition">
                            Se connecter
                        </a>
                    </p>

                    <!-- MESSAGE DE SÉCURITÉ -->
                    <div class="mt-4 flex items-center justify-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>Vos informations sont sécurisées</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


<script>
    // liste des regions et villes dans le maroc
    const regionsCities = {
        "Tanger-Tétouan-Al Hoceima": [
            "Tanger", "Tétouan", "Al Hoceima", "Chefchaouen", "Larache", "Assilah", "Fnideq"
        ],
        "L'Oriental": [
            "Oujda", "Nador", "Berkane", "Taourirt", "Jerada", "Figuig"
        ],
        "Fès-Meknès": [
            "Fès", "Meknès", "Ifrane", "Azrou", "Sefrou", "Taza"
        ],
        "Rabat-Salé-Kénitra": [
            "Rabat", "Salé", "Kénitra", "Témara", "Skhirat", "Sidi Kacem"
        ],
        "Béni Mellal-Khénifra": [
            "Béni Mellal", "Khénifra", "Khouribga", "Azilal", "Fquih Ben Salah"
        ],
        "Casablanca-Settat": [
            "Casablanca", "Settat", "El Jadida", "Mohammedia", "Berrechid", "Benslimane"
        ],
        "Marrakech-Safi": [
            "Marrakech", "Safi", "Essaouira", "Youssoufia", "Chichaoua", "El Kelaa"
        ],
        "Drâa-Tafilalet": [
            "Ouarzazate", "Errachidia", "Tinghir", "Zagora", "Midelt"
        ],
        "Souss-Massa": [
            "Agadir", "Taroudant", "Tiznit", "Inezgane", "Ait Melloul", "Tata"
        ],
        "Guelmim-Oued Noun": [
            "Guelmim", "Tan-Tan", "Sidi Ifni", "Assa-Zag"
        ],
        "Laâyoune-Sakia El Hamra": [
            "Laâyoune", "Boujdour", "Tarfaya", "Es-Semara"
        ],
        "Dakhla-Oued Ed-Dahab": [
            "Dakhla"
        ]
    };


    const regionSelect = document.getElementById('region');
    const citySelect = document.getElementById('city');
    
    const oldCity = "{{ old('city') }}";

    function updateCities() {
        const selectedRegion = regionSelect.value;
        
        citySelect.innerHTML = '<option value="">-- Choisir une ville --</option>';
        
        if (selectedRegion && regionsCities[selectedRegion]) {
            const cities = regionsCities[selectedRegion];
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;

                    if (city === oldCity) {
                        option.selected = true;
                    }
                    citySelect.appendChild(option);
                });
        }
    }

    regionSelect.addEventListener('change', updateCities);
    
    if (regionSelect.value) {
        updateCities();
    }
</script>

@endsection