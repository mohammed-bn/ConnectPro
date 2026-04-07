@extends('layouts.app')

@section('title', 'Dashboard Pro Max')

@section('content')

<style>
/* ❌ Hide scrollbar but keep scroll functional */
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div class="h-screen bg-gray-100 dark:bg-slate-900 overflow-hidden">

    <!-- NAVBAR -->
    <div class="h-[80px] sticky top-0 z-40 bg-white dark:bg-slate-800 shadow flex items-center justify-between px-6 py-3">

        <!-- SEARCH -->
        <div class="w-1/2 flex gap-2">
            <input type="text"
                   placeholder="🔍 Rechercher un professionnel..."
                   id="searchInput"
                   class="w-full p-2 rounded-lg bg-gray-100 dark:bg-slate-700 outline-none focus:ring-2 focus:ring-blue-500">

            <button onclick="toggleFilters()"
                    class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
                ⚙️ Filtrer
            </button>
        </div>

        <!-- ACTIONS -->
        <div class="flex items-center gap-6 text-xl text-slate-600 dark:text-gray-300">
            <button>🔔</button>
            <button>💬</button>
            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png"
                 class="w-10 h-10 rounded-full border-2 border-blue-500">
        </div>
    </div>

    <!-- FILTERS -->
    <div id="filters" class="max-w-7xl mx-auto px-6 mt-4 hidden transition-all duration-300">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow p-4 grid md:grid-cols-4 gap-4">

            <select id="filterCategory" class="p-2 rounded-lg bg-gray-100 dark:bg-slate-700">
                <option value="">Catégorie</option>
                <option>Médecin</option>
                <option>Avocat</option>
                <option>Développeur</option>
            </select>

            <select id="filterSpeciality" class="p-2 rounded-lg bg-gray-100 dark:bg-slate-700">
                <option value="">Spécialité</option>
                <option>Cardiologie</option>
                <option>Droit</option>
            </select>

            <input type="text" id="filterCity" placeholder="Ville"
                   class="p-2 rounded-lg bg-gray-100 dark:bg-slate-700">

            <input type="text" id="filterRegion" placeholder="Région"
                   class="p-2 rounded-lg bg-gray-100 dark:bg-slate-700">

            <button onclick="applyFilters()" class="bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition col-span-4">
                Appliquer
            </button>
        </div>
    </div>

    <!-- GRID -->
    <div class="max-w-7xl mx-auto grid md:grid-cols-4 gap-6 px-6 pt-6">

        <!-- LEFT -->
        <aside class="hidden md:flex flex-col gap-6">

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow p-4 text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png"
                     class="w-20 h-20 rounded-full mx-auto mb-3 border-4 border-blue-500">

                <h2 class="font-bold text-slate-800 dark:text-white">Nom User</h2>

                <a href="#"
                   class="mt-3 inline-block bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
                    Voir Profil
                </a>
            </div>

        </aside>

        <!-- FEED -->
        <main class="md:col-span-2 space-y-6 overflow-y-auto h-[calc(100vh-80px)] pr-2 no-scrollbar">

            <!-- CREATE POST -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow p-4">
                <textarea placeholder="Partager une idée..."
                          class="w-full p-3 rounded-lg bg-gray-100 dark:bg-slate-700 mb-3"></textarea>

                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">📷 Photo • 🎥 Vidéo</span>

                    <button class="bg-blue-600 text-white px-5 py-2 rounded-xl hover:bg-blue-700 transition">
                        Publier
                    </button>
                </div>
            </div>

            <!-- POSTS -->
            @for ($i = 0; $i < 10; $i++)
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow p-5">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                         class="w-12 h-12 rounded-full">
                    <div>
                        <h3 class="font-bold text-slate-800 dark:text-white">Dr. Ahmed</h3>
                        <p class="text-sm text-gray-500">Casablanca • 2h</p>
                    </div>
                </div>

                <p class="text-gray-600 dark:text-gray-300 mb-3">
                    Consultation disponible cette semaine.
                </p>

                <div class="flex justify-between text-sm border-t pt-3 text-gray-500">
                    <button class="hover:text-blue-500">👍 Like</button>
                    <button onclick="toggleComment({{ $i }})" class="hover:text-blue-500">💬 Comment</button>
                    <button class="hover:text-blue-500">📤 Share</button>
                </div>

                <div id="comment-{{ $i }}" class="hidden mt-3">
                    <input type="text"
                           placeholder="Commenter..."
                           class="w-full p-2 rounded bg-gray-100 dark:bg-slate-700">
                </div>
            </div>
            @endfor

        </main>

        <!-- RIGHT -->
        <aside class="hidden md:flex flex-col gap-6">

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow p-4">
                <h3 class="font-bold mb-3 text-slate-800 dark:text-white">Suggestions</h3>

                <div class="flex justify-between mb-2">
                    <span>Dr. Sara</span>
                    <button class="text-blue-500">Suivre</button>
                </div>

            </div>

        </aside>

    </div>

</div>

<script>
function toggleComment(id) {
    document.getElementById('comment-' + id).classList.toggle('hidden');
}

function toggleFilters() {
    const el = document.getElementById('filters');
    el.classList.toggle('hidden');
}

function applyFilters() {
    const category = document.getElementById('filterCategory').value;
    const speciality = document.getElementById('filterSpeciality').value;
    const city = document.getElementById('filterCity').value;
    const region = document.getElementById('filterRegion').value;

    alert(`Filtres appliqués:\nCatégorie: ${category}\nSpécialité: ${speciality}\nVille: ${city}\nRégion: ${region}`);
}
</script>

@endsection