@extends('layouts.app')

@section('title', 'Modifier mon profil - ConnectPro')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-10 px-4 sm:px-6 lg:px-8">
    
    <div class="max-w-5xl mx-auto">
        
        <!-- CARD PRINCIPALE -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">
            
            <!-- EN-TÊTE DE LA CARD -->
            <div class="bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] px-6 py-4">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-[#FFB703]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <h2 class="text-xl font-semibold text-white">Informations personnelles</h2>
                </div>
            </div>

            <!-- FORMULAIRE -->
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <!-- MESSAGE DE SUCCÈS -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-xl border border-green-200 dark:border-green-800 flex items-center gap-3">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- MESSAGES D'ERREUR GLOBAUX -->
                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-xl border border-red-200 dark:border-red-800">
                        <div class="flex items-center gap-3 mb-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold">Veuillez corriger les erreurs suivantes :</span>
                        </div>
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- SECTION PHOTO -->
                <div class="flex flex-col sm:flex-row items-center gap-6 mb-8 pb-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="relative">
                        <img id="preview"
                            src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0A2647&color=FFB703&size=120' }}"
                            class="w-28 h-28 rounded-full object-cover border-4 border-[#FFB703] shadow-lg">
                        <div class="absolute bottom-0 right-0 w-5 h-5 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></div>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Photo de profil
                        </label>
                        <input type="file" name="photo" id="photo"
                            class="block w-full text-sm text-gray-500 dark:text-gray-400
                                   file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0
                                   file:bg-gradient-to-r file:from-[#0A2647] file:to-[#1E4A6D]
                                   file:text-white file:font-semibold file:cursor-pointer
                                   hover:file:from-[#1E4A6D] hover:file:to-[#2C7DA0] transition">
                        <p class="text-xs text-gray-400 mt-2">Format acceptés : JPG, PNG, GIF. Max 2MB</p>
                        @error('photo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- GRILLE 2 COLONNES -->
                <div class="grid md:grid-cols-2 gap-6">
                    
                    <!-- NOM -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Nom complet <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition">
                        </div>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- TÉLÉPHONE -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Téléphone
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition">
                        </div>
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- RÉGION (SELECT) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Région <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <select id="region" name="region" 
                                class="w-full pl-10 pr-10 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition appearance-none">
                                <option value="">-- Choisir une région --</option>
                                <option value="Tanger-Tétouan-Al Hoceïma" {{ old('region', $user->region) == 'Tanger-Tétouan-Al Hoceïma' ? 'selected' : '' }}>Tanger-Tétouan-Al Hoceïma</option>
                                <option value="Oriental" {{ old('region', $user->region) == 'Oriental' ? 'selected' : '' }}>Oriental</option>
                                <option value="Fès-Meknès" {{ old('region', $user->region) == 'Fès-Meknès' ? 'selected' : '' }}>Fès-Meknès</option>
                                <option value="Rabat-Salé-Kénitra" {{ old('region', $user->region) == 'Rabat-Salé-Kénitra' ? 'selected' : '' }}>Rabat-Salé-Kénitra</option>
                                <option value="Béni Mellal-Khénifra" {{ old('region', $user->region) == 'Béni Mellal-Khénifra' ? 'selected' : '' }}>Béni Mellal-Khénifra</option>
                                <option value="Casablanca-Settat" {{ old('region', $user->region) == 'Casablanca-Settat' ? 'selected' : '' }}>Casablanca-Settat</option>
                                <option value="Marrakech-Safi" {{ old('region', $user->region) == 'Marrakech-Safi' ? 'selected' : '' }}>Marrakech-Safi</option>
                                <option value="Drâa-Tafilalet" {{ old('region', $user->region) == 'Drâa-Tafilalet' ? 'selected' : '' }}>Drâa-Tafilalet</option>
                                <option value="Souss-Massa" {{ old('region', $user->region) == 'Souss-Massa' ? 'selected' : '' }}>Souss-Massa</option>
                                <option value="Guelmim-Oued Noun" {{ old('region', $user->region) == 'Guelmim-Oued Noun' ? 'selected' : '' }}>Guelmim-Oued Noun</option>
                                <option value="Laâyoune-Sakia El Hamra" {{ old('region', $user->region) == 'Laâyoune-Sakia El Hamra' ? 'selected' : '' }}>Laâyoune-Sakia El Hamra</option>
                                <option value="Dakhla-Oued Ed-Dahab" {{ old('region', $user->region) == 'Dakhla-Oued Ed-Dahab' ? 'selected' : '' }}>Dakhla-Oued Ed-Dahab</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('region')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- VILLE (SELECT DYNAMIQUE) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Ville <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <select id="city" name="city" 
                                class="w-full pl-10 pr-10 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition appearance-none">
                                <option value="">-- Choisir une ville --</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('city')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ADRESSE -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Adresse
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}"
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition">
                        </div>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- CATÉGORIE (SELECT) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Catégorie <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <select id="categorySelect" name="category" 
                                class="w-full pl-10 pr-10 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition appearance-none">
                                <option value="">-- Sélectionner une catégorie --</option>
                                <option value="sante" {{ old('category', $user->category) == 'sante' ? 'selected' : '' }}> Santé</option>
                                <option value="droit" {{ old('category', $user->category) == 'droit' ? 'selected' : '' }}> Droit / Justice</option>
                                <option value="ingenierie" {{ old('category', $user->category) == 'ingenierie' ? 'selected' : '' }}> Ingénierie / Construction</option>
                                <option value="informatique" {{ old('category', $user->category) == 'informatique' ? 'selected' : '' }}> Informatique / Digital</option>
                                <option value="marketing" {{ old('category', $user->category) == 'marketing' ? 'selected' : '' }}> Marketing / Communication</option>
                                <option value="finance" {{ old('category', $user->category) == 'finance' ? 'selected' : '' }}> Finance / Comptabilité</option>
                                <option value="education" {{ old('category', $user->category) == 'education' ? 'selected' : '' }}> Éducation / Formation</option>
                                <option value="artisanat" {{ old('category', $user->category) == 'artisanat' ? 'selected' : '' }}> Artisanat / Technique</option>
                                <option value="hotellerie" {{ old('category', $user->category) == 'hotellerie' ? 'selected' : '' }}> Services / Hôtellerie</option>
                                <option value="transport" {{ old('category', $user->category) == 'transport' ? 'selected' : '' }}> Transport / Logistique</option>
                                <option value="immobilier" {{ old('category', $user->category) == 'immobilier' ? 'selected' : '' }}> Immobilier</option>
                                <option value="creatif" {{ old('category', $user->category) == 'creatif' ? 'selected' : '' }}> Créatif / Média</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('category')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- SPÉCIALITÉ (SELECT DYNAMIQUE) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Spécialité <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <select id="specialtySelect" "speciality" required 
                                class="w-full pl-10 pr-10 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition appearance-none">
                                <option value="">-- Sélectionner une spécialité --</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        @error('specialty')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- EMAIL (readonly) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="email" value="{{ $user->email }}" disabled
                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 cursor-not-allowed">
                        </div>
                    </div>
                </div>

                <!-- BIO -->
                <div class="mt-6">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Bio / Description
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                        </div>
                        <textarea name="bio" rows="5"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#FFB703] focus:border-transparent outline-none transition resize-none"
                            placeholder="Présentez-vous, votre parcours, vos compétences...">{{ old('bio', $user->professionnel->bio ?? '') }}</textarea>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Maximum 500 caractères</p>
                    @error('bio')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- BOUTONS D'ACTION -->
                <div class="flex flex-wrap gap-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit"
                        class="flex-1 sm:flex-none bg-gradient-to-r from-[#0A2647] to-[#1E4A6D] hover:from-[#1E4A6D] hover:to-[#2C7DA0] text-white font-semibold px-8 py-3 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Enregistrer les modifications
                    </button>
                    
                    <a href="#" 
                        class="flex-1 sm:flex-none border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-semibold px-8 py-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Annuler
                    </a>
                </div>

            </form>
        </div>

        <!-- MESSAGE DE SÉCURITÉ -->
        <div class="mt-6 text-center">
            <p class="text-xs text-gray-500 dark:text-gray-400">
                <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                </svg>
                Toutes vos informations sont sécurisées et confidentielles
            </p>
        </div>

    </div>
</div>

<!-- JavaScript pour la gestion des villes et spécialités -->
<script>
    // ==================== GESTION DES VILLES ====================
    const regionsCities = {
        "Tanger-Tétouan-Al Hoceïma": ["Tanger", "Tétouan", "Al Hoceïma", "Chefchaouen", "Larache", "Fnideq", "M'diq", "Martil"],
        "Oriental": ["Oujda", "Nador", "Berkane", "Taourirt", "Jerada", "Ahfir", "Saidia", "Guercif"],
        "Fès-Meknès": ["Fès", "Meknès", "Taza", "Sefrou", "Ifrane", "Azrou", "El Hajeb", "Boulemane"],
        "Rabat-Salé-Kénitra": ["Rabat", "Salé", "Kénitra", "Témara", "Sidi Kacem", "Sidi Slimane", "Khemisset", "Skhirat"],
        "Béni Mellal-Khénifra": ["Béni Mellal", "Khénifra", "Azilal", "Fquih Ben Salah", "Kasba Tadla", "Ouaouizaght"],
        "Casablanca-Settat": ["Casablanca", "Settat", "Mohammedia", "El Jadida", "Berrechid", "Bouskoura", "Mediouna", "Nouaceur"],
        "Marrakech-Safi": ["Marrakech", "Safi", "Essaouira", "El Kelaa des Sraghna", "Chichaoua", "Ben Guerir", "Youssoufia"],
        "Drâa-Tafilalet": ["Ouarzazate", "Errachidia", "Zagora", "Tinghir", "Midelt", "Rissani"],
        "Souss-Massa": ["Agadir", "Taroudant", "Tiznit", "Inezgane", "Aït Melloul", "Oulad Teima", "Chtouka"],
        "Guelmim-Oued Noun": ["Guelmim", "Tan-Tan", "Sidi Ifni", "Bouizakarne", "Assa", "Zag"],
        "Laâyoune-Sakia El Hamra": ["Laâyoune", "Smara", "Tarfaya", "Boujdour", "El Marsa"],
        "Dakhla-Oued Ed-Dahab": ["Dakhla", "Aousserd", "Bir Gandouz", "Guelb er Richat"]
    };

    // ==================== GESTION DES SPÉCIALITÉS PAR CATÉGORIE ====================
    const specialtiesByCategory = {
        "sante": [
            "Médecine générale", "Médecine spécialisée", "Dentisterie", 
            "Pharmacie", "Infirmier / Infirmière", "Kinésithérapie", "Psychologie"
        ],
        "droit": [
            "Avocat", "Notaire", "Conseiller juridique", 
            "Huissier de justice", "Juriste d'entreprise"
        ],
        "ingenierie": [
            "Ingénieur civil", "Architecte", "Électricien", 
            "Plombier", "Technicien BTP", "Chef de chantier"
        ],
        "informatique": [
            "Développeur web", "Développeur mobile", "Data analyst", 
            "UI/UX designer", "Administrateur système", "Expert cybersécurité"
        ],
        "marketing": [
            "Marketing digital", "Community manager", "SEO specialist", 
            "Graphiste", "Copywriter", "Publicité / Ads manager"
        ],
        "finance": [
            "Comptable", "Auditeur", "Conseiller financier", 
            "Banquier", "Analyste financier"
        ],
        "education": [
            "Enseignant", "Formateur", "Coach éducatif", "Professeur particulier"
        ],
        "artisanat": [
            "Mécanicien", "Électricien industriel", "Menuisier", 
            "Soudeur", "Peintre bâtiment"
        ],
        "hotellerie": [
            "Réceptionniste", "Serveur", "Chef cuisinier", "Manager hôtelier"
        ],
        "transport": [
            "Chauffeur", "Livreur", "Logisticien", "Gestionnaire de stock"
        ],
        "immobilier": [
            "Agent immobilier", "Gestionnaire de biens", "Promoteur immobilier"
        ],
        "creatif": [
            "Photographe", "Vidéaste", "Monteur vidéo", "Designer graphique", "Artiste"
        ]
    };

    // Récupération des éléments
    const regionSelect = document.getElementById('region');
    const citySelect = document.getElementById('city');
    const categorySelect = document.getElementById('categorySelect');
    const specialtySelect = document.getElementById('specialtySelect');
    
    const oldCity = "{{ old('city', $user->city) }}";
    const oldSpecialty = "{{ old('specialty', $user->professionnel->specialty ?? '') }}";
    const oldCategory = "{{ old('category', $user->category ?? '') }}";

    // ==================== FONCTION POUR LES VILLES ====================
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

    // ==================== FONCTION POUR LES SPÉCIALITÉS ====================
    function updateSpecialties() {
        const selectedCategory = categorySelect.value;
        specialtySelect.innerHTML = '<option value="">-- Sélectionner une spécialité --</option>';
        
        if (selectedCategory && specialtiesByCategory[selectedCategory]) {
            const specialties = specialtiesByCategory[selectedCategory];
            specialties.forEach(specialty => {
                const option = document.createElement('option');
                option.value = specialty;
                option.textContent = specialty;
                if (specialty === oldSpecialty) {
                    option.selected = true;
                }
                specialtySelect.appendChild(option);
            });
        }
    }

    // ==================== ÉCOUTEURS D'ÉVÉNEMENTS ====================
    if (regionSelect) {
        regionSelect.addEventListener('change', updateCities);
        if (regionSelect.value) {
            updateCities();
        }
    }

    if (categorySelect) {
        categorySelect.addEventListener('change', updateSpecialties);
        // Initialiser les spécialités si une catégorie est déjà sélectionnée
        if (oldCategory) {
            // Définir la valeur sélectionnée
            categorySelect.value = oldCategory;
            updateSpecialties();
        }
    }

    // ==================== PREVIEW IMAGE ====================
    const photoInput = document.getElementById('photo');
    const previewImg = document.getElementById('preview');

    if (photoInput) {
        photoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    previewImg.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>

@endsection