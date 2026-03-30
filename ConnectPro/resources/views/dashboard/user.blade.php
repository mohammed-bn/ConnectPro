@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800 p-6">

    <!-- HEADER SEARCH -->
    <div class="max-w-5xl mx-auto mb-8">

        <div class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-lg shadow-xl rounded-2xl p-4">

            <!-- SEARCH BAR -->
            <div class="flex items-center gap-3">

                <input type="text"
                       placeholder="🔍 Rechercher un professionnel, service..."
                       class="w-full p-3 rounded-xl bg-gray-100 dark:bg-gray-700 outline-none focus:ring-2 focus:ring-[#569BAB] transition">

                <!-- TOGGLE FILTER -->
                <button onclick="toggleFilters()"
                        class="bg-[#569BAB] text-white px-4 py-3 rounded-xl hover:bg-[#305F70] transition">
                    ⚙️
                </button>

            </div>

            <!-- COLLAPS FILTER -->
            <div id="filters"
                 class="overflow-hidden max-h-0 opacity-0 transition-all duration-500 ease-in-out mt-4">

                <div class="grid md:grid-cols-3 gap-4 pt-4">

                    <select class="p-3 rounded-xl bg-gray-100 dark:bg-gray-700">
                        <option>Catégorie</option>
                        <option>Médecin</option>
                        <option>Avocat</option>
                        <option>Développeur</option>
                    </select>

                    <select class="p-3 rounded-xl bg-gray-100 dark:bg-gray-700">
                        <option>Spécialité</option>
                        <option>Cardiologie</option>
                        <option>Droit</option>
                    </select>

                    <input type="text" placeholder="📍 Localisation"
                           class="p-3 rounded-xl bg-gray-100 dark:bg-gray-700">

                </div>

                <div class="mt-4 text-right">
                    <button class="bg-[#305F70] text-white px-6 py-2 rounded-xl hover:bg-[#569BAB] transition">
                        Appliquer
                    </button>
                </div>

            </div>

        </div>

    </div>

    <!-- FEED -->
    <div class="max-w-5xl mx-auto space-y-6">

        @for ($i = 0; $i < 5; $i++)

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1 p-6">

            <!-- HEADER -->
            <div class="flex items-center gap-4 mb-4">

                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                     class="w-14 h-14 rounded-full border-2 border-[#569BAB]">

                <div>
                    <h3 class="font-bold text-lg text-[#305F70]">
                        Dr. Ahmed Benali
                    </h3>
                    <p class="text-sm text-gray-500">
                        Cardiologue • Marrakech
                    </p>
                </div>

            </div>

            <!-- CONTENT -->
            <p class="text-gray-600 dark:text-gray-300 mb-5 leading-relaxed">
                Spécialiste avec plus de 10 ans d'expérience. Consultation rapide,
                diagnostic précis et suivi personnalisé.
            </p>

            <!-- ACTIONS -->
            <div class="flex gap-3">

                <a href="#"
                   class="px-4 py-2 bg-[#569BAB] text-white rounded-xl hover:bg-[#305F70] transition">
                    Voir profil
                </a>

                <button
                    class="px-4 py-2 border border-[#569BAB] text-[#569BAB] rounded-xl hover:bg-[#569BAB] hover:text-white transition">
                    Contacter
                </button>

            </div>

        </div>

        @endfor

    </div>

</div>

<!-- SCRIPT -->
<script>
function toggleFilters() {
    const el = document.getElementById('filters');

    if (el.classList.contains('max-h-0')) {
        el.classList.remove('max-h-0', 'opacity-0');
        el.classList.add('max-h-[500px]', 'opacity-100');
    } else {
        el.classList.add('max-h-0', 'opacity-0');
        el.classList.remove('max-h-[500px]', 'opacity-100');
    }
}
</script>

@endsection