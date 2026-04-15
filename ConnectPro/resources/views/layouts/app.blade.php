<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'ConnectPro')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- VITE -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- ANIMATIONS -->
    <style>
        @keyframes fadeSlideLeft {
            from { opacity: 0; transform: translateX(-40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeScale {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .animate-image {
            animation: fadeSlideLeft 0.8s ease forwards;
        }

        .animate-form {
            animation: fadeScale 0.8s ease 0.2s forwards;
            opacity: 0;
        }
    </style>
</head>

<body class="font-['Plus_Jakarta_Sans'] bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-white transition duration-300">

<!-- NAVBAR -->
<nav class="sticky top-0 z-50 bg-white shadow-md dark:bg-gray-900 dark:border-b dark:border-gray-700">
    <div class="container mx-auto flex justify-between items-center p-4">

        <!-- LOGO VERSION 2 - ÉPURÉ & MODERNE -->
        <a href="{{ url('/') }}" class="flex items-center gap-3 transition-all duration-300 group">
            <!-- Icône : Nœud de connexion / Lien entre deux entités -->
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 100 100" class="transform transition-transform duration-300 group-hover:scale-105">
                    <!-- Cercle de fond (réseau) -->
                    <circle cx="50" cy="50" r="44" fill="#F0F7FF" stroke="#1E4A6D" stroke-width="2"/>
                    
                    <!-- Point central (connexion) -->
                    <circle cx="50" cy="50" r="6" fill="#1E4A6D"/>
                    
                    <!-- Cercle utilisateur (gauche) -->
                    <circle cx="28" cy="50" r="12" fill="none" stroke="#3A7CA5" stroke-width="3"/>
                    <path d="M16 72 Q19 58 28 55 Q37 58 40 72" fill="#3A7CA5"/>
                    
                    <!-- Cercle professionnel (droite) -->
                    <circle cx="72" cy="50" r="12" fill="none" stroke="#3A7CA5" stroke-width="3"/>
                    <path d="M60 72 Q63 58 72 55 Q81 58 84 72" fill="#3A7CA5"/>
                    
                    <!-- Lignes de connexion horizontales -->
                    <line x1="34" y1="50" x2="44" y2="50" stroke="#D4A373" stroke-width="2.5" stroke-dasharray="4 3"/>
                    <line x1="56" y1="50" x2="66" y2="50" stroke="#D4A373" stroke-width="2.5" stroke-dasharray="4 3"/>
                </svg>
            </div>
            
            <!-- Texte de la marque -->
            <div class="flex flex-col">
                <span class="font-extrabold text-2xl tracking-tight text-[#1E4A6D] dark:text-white">ConnectPro</span>
                <span class="text-[0.6rem] font-semibold tracking-[0.2em] uppercase text-[#D4A373]">Bridge the gap</span>
            </div>
        </a>

        <!-- LIENS DE NAVIGATION -->
        <div class="flex items-center gap-6">
            @guest
                <a href="{{ route('login') }}"
                   class="text-[#1E4A6D] dark:text-white/80 hover:text-[#D4A373] dark:hover:text-[#D4A373] font-semibold transition duration-200">
                    Connexion
                </a>

                <a href="{{ route('register') }}"
                   class="bg-[#1E4A6D] px-5 py-2.5 rounded-full text-white font-semibold hover:bg-[#D4A373] transition-all duration-200 transform hover:scale-105 shadow-sm">
                    Inscription
                </a>
            @endguest

            @auth
                <span class="text-[#1E4A6D] dark:text-white/80 font-semibold">Bonjour, {{ auth()->user()->name }}</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="text-[#1E4A6D] dark:text-white/70 hover:text-[#D4A373] font-semibold transition">
                        Déconnexion
                    </button>
                </form>
            @endauth
        </div>
    </div>
</nav>

<!-- CONTENT -->
<main class="min-h-screen">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="bg-[#1E4A6D] text-white/90 pt-12 pb-6">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Colonne 1: Marque -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="44" fill="none" stroke="#D4A373" stroke-width="1.5"/>
                        <circle cx="50" cy="50" r="5" fill="#D4A373"/>
                        <circle cx="28" cy="50" r="10" fill="none" stroke="#ffffff" stroke-width="2"/>
                        <path d="M16 72 Q19 60 28 57 Q37 60 40 72" fill="#ffffff"/>
                        <circle cx="72" cy="50" r="10" fill="none" stroke="#ffffff" stroke-width="2"/>
                        <path d="M60 72 Q63 60 72 57 Q81 60 84 72" fill="#ffffff"/>
                    </svg>
                    <span class="font-bold text-xl">ConnectPro</span>
                </div>
                <p class="text-sm text-white/70 leading-relaxed">
                    Plateforme de mise en relation entre professionnels et utilisateurs.
                </p>
            </div>

            <!-- Colonne 2: Services -->
            <div>
                <h3 class="font-semibold text-lg mb-4 text-white">Services</h3>
                <ul class="space-y-2 text-sm text-white/70">
                    <li><a href="#" class="hover:text-[#D4A373] transition">Recherche de professionnels</a></li>
                    <li><a href="#" class="hover:text-[#D4A373] transition">Consultation en ligne</a></li>
                    <li><a href="#" class="hover:text-[#D4A373] transition">Messagerie instantanée</a></li>
                    <li><a href="#" class="hover:text-[#D4A373] transition">Gestion de profil</a></li>
                </ul>
            </div>

            <!-- Colonne 3: À propos -->
            <div>
                <h3 class="font-semibold text-lg mb-4 text-white">À propos</h3>
                <ul class="space-y-2 text-sm text-white/70">
                    <li><a href="#" class="hover:text-[#D4A373] transition">Qui sommes-nous</a></li>
                    <li><a href="#" class="hover:text-[#D4A373] transition">Contact</a></li>
                    <li><a href="#" class="hover:text-[#D4A373] transition">Conditions d'utilisation</a></li>
                    <li><a href="#" class="hover:text-[#D4A373] transition">Politique de confidentialité</a></li>
                </ul>
            </div>

            <!-- Colonne 4: Suivez-nous -->
            <div>
                <h3 class="font-semibold text-lg mb-4 text-white">Suivez-nous</h3>
                <div class="flex gap-4 mt-2">
                    <a href="#" class="text-white/60 hover:text-[#D4A373] transition" aria-label="Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879V14.89h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.989C18.343 21.129 22 16.99 22 12z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-white/60 hover:text-[#D4A373] transition" aria-label="LinkedIn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C0.792 0 0 0.774 0 1.729v20.542C0 23.227 0.792 24 1.771 24h20.451c0.979 0 1.771-0.773 1.771-1.729V1.729C24 0.774 23.206 0 22.225 0z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-white/60 hover:text-[#D4A373] transition" aria-label="Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 0021.803-4.78c3.732-6.318 2.718-12.7-1.002-16.87z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-white/20 mt-8 pt-6 text-center text-sm text-white/50">
            © 2026 ConnectPro. Tous droits réservés.
        </div>
    </div>
</footer>

</body>
</html>