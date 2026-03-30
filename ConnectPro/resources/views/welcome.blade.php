@extends('layouts.app')

@section('title', 'Accueil')

@section('content')

<!-- HERO SECTION -->
<section class="grid md:grid-cols-2 gap-10 items-center p-10">

    <!-- TEXT -->
    <div class="flex flex-col justify-center">
        <h1 class="text-5xl font-bold text-[#569BAB] mb-4 leading-tight">
            🌐 Bienvenue sur notre plateforme
        </h1>

        <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">
            Trouvez facilement des professionnels qualifiés, proches de chez vous et adaptés à vos besoins.
        </p>

        <!-- BUTTON INSCRIPTION -->
        <a href="{{ route('register') }}">
            <button class="bg-[#569BAB] text-white px-8 py-3 rounded-xl shadow-lg hover:bg-[#305F70] transition transform hover:scale-105 text-lg">
                🚀 S'inscrire maintenant
            </button>
        </a>
    </div>

    <!-- IMAGE ILLUSTRATION -->
<img src="https://images.openai.com/static-rsc-4/UGN8sU6Miu5lIT4yJ3TtdW3C2jjKrgtp_5Oz0FgxLCiqSH312q9qPw7qXDsM2d3Thuv98NPx9o9jZXIB0DUp6EG1_ZHAYCcj5wQF-us-pxtc4zuOthbgvgWHmMk1mG1rxRMVUf3-Fuy1Ife9kGt9iEOqYBhDcec6VgOIL7xCXnOr7CwHVakWyjV7LJ9_l0ui?purpose=fullsize"
     alt="Recherche professionnel illustration"
     class="w-full max-w-[600px] mx-auto rounded-2xl shadow-xl">

</section>

<!-- DESCRIPTION CARDS -->
<section class="max-w-6xl mx-auto p-10 grid md:grid-cols-2 gap-6">

    <!-- INTRO -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-xl transition">
        <p>
            Dans un monde en pleine digitalisation, l’accès aux services professionnels doit être simple, rapide et fiable. Pourtant, trouver un professionnel qualifié, disponible et proche de chez soi reste souvent un véritable défi.
        </p>
    </div>

    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-xl transition">
        <p>
            Notre plateforme facilite la mise en relation entre utilisateurs et professionnels en offrant une expérience moderne et intuitive.
        </p>
    </div>

    <!-- USERS -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-xl transition">
        <h2 class="text-xl font-semibold text-[#305F70] dark:text-[#569BAB] mb-2">
            🔍 Pour les utilisateurs
        </h2>
        <p>
            Trouvez facilement le professionnel idéal grâce à une recherche intelligente basée sur la localisation et les services proposés.
        </p>
    </div>

    <!-- PROFESSIONALS -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow hover:shadow-xl transition">
        <h2 class="text-xl font-semibold text-[#305F70] dark:text-[#569BAB] mb-2">
            💼 Pour les professionnels
        </h2>
        <p>
            Présentez vos services, améliorez votre visibilité et développez votre réseau de clients efficacement.
        </p>
    </div>

    <!-- OBJECTIF -->
    <div class="md:col-span-2 bg-gradient-to-r from-[#569BAB] to-[#305F70] text-white p-8 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-3">🚀 Notre objectif</h2>
        <p>
            Offrir une solution moderne et efficace pour connecter les utilisateurs aux bons professionnels, en rendant la recherche plus rapide, organisée et accessible à tous.
        </p>
        <p class="mt-4 font-semibold">
            Rejoignez-nous dès aujourd’hui et découvrez une nouvelle manière de trouver et proposer des services professionnels.
        </p>
    </div>

</section>

@endsection