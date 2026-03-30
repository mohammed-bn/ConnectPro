<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'ConnectPro')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

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

<body class="font-[Poppins] bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-white transition duration-300">

<!-- NAVBAR -->
<nav class="sticky top-0 z-50 bg-[#305F70] shadow-lg backdrop-blur-md">
    <div class="container mx-auto flex justify-between items-center p-4">

        <!-- LOGO CLICKABLE -->
        <a href="{{ url('/') }}" class="flex items-center gap-3 text-white font-bold text-xl transition transform hover:scale-105">
            <!-- SVG HANDSHAKE PRO -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" viewBox="0 0 24 24" fill="none" stroke="white">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 12l4-4a3 3 0 014 0l1 1a3 3 0 004 0l3-3M2 14l5 5a3 3 0 004 0l1-1a3 3 0 014 0l4 4"/>
            </svg>
            <span class="tracking-wide">ConnectPro</span>
        </a>

        <!-- LINKS -->
        <div class="flex items-center gap-5">

            <!-- DARK MODE BUTTON -->
            <button onclick="toggleDark()" 
                    id="themeIcon"
                    class="text-white text-2xl transition transform hover:scale-110">
                🌙
            </button>

            @guest
                <a href="{{ route('login') }}"
                   class="text-white hover:text-[#9EBFAD] transition">
                    Connexion
                </a>

                <a href="{{ route('register') }}"
                   class="bg-[#569BAB] px-5 py-2 rounded-xl text-white hover:bg-[#9EBFAD] transition transform hover:scale-105 shadow">
                    Inscription
                </a>
            @endguest

            @auth
                <span class="text-white">Bonjour, {{ auth()->user()->name }}</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="text-white hover:text-red-300 ml-2">
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
<footer class="bg-[#305F70] text-white text-center p-4">
    © {{ date('Y') }} ConnectPro - Tous droits réservés
</footer>

<!-- DARK MODE SCRIPT -->
<script>
    const html = document.documentElement;
    const icon = document.getElementById('themeIcon');

    function updateIcon() {
        if (html.classList.contains('dark')) {
            icon.textContent = '☀️';
        } else {
            icon.textContent = '🌙';
        }
    }

    function toggleDark() {
        html.classList.toggle('dark');
        localStorage.setItem('darkMode', html.classList.contains('dark'));
        updateIcon();
    }

    // Load saved mode
    if (localStorage.getItem('darkMode') === 'true') {
        html.classList.add('dark');
    }

    updateIcon();
</script>


</body>
</html>