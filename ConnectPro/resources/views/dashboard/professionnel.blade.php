@extends('layouts.app')

@section('title', 'Dashboard Professionnel')

@section('content')

<section class="min-h-screen bg-gray-100 dark:bg-gray-900 p-6">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-6">

        <!-- LEFT SIDEBAR -->
        <aside class="w-full md:w-1/4 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-4 flex flex-col gap-4">

            <!-- Profile Summary -->
            <div class="flex flex-col items-center text-center p-4 border-b border-gray-200 dark:border-gray-700">
                <img src="{{ auth()->user()->photo ?? 'https://cdn-icons-png.flaticon.com/512/1077/1077063.png' }}"
                     alt="Profil"
                     class="w-24 h-24 rounded-full mb-2 object-cover">
                <h2 class="font-bold text-lg text-[#305F70]">{{ auth()->user()->name }}</h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm">
                    Professionnel
                </p>
                <a href="{{route('profile.profile')}}"
                   class="mt-2 px-3 py-1 bg-[#569BAB] text-white rounded-full text-sm hover:bg-[#305F70] transition">
                    Voir profil
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="flex flex-col gap-3 mt-4">
                <a href="#" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:text-[#569BAB]">
                    📝 Mes publications
                </a>
                <a href="#" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:text-[#569BAB]">
                    💌 Messages
                </a>
                <a href="#" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:text-[#569BAB]">
                    📩 Demandes de consultation
                </a>
                <a href="#" class="flex items-center gap-2 text-gray-700 dark:text-gray-300 hover:text-[#569BAB]">
                    ⚙️ Paramètres du profil
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 flex flex-col gap-6">

            <!-- POST CREATE BOX -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-4 flex flex-col gap-3">
                <h3 class="text-[#305F70] font-bold text-lg">Créer une publication</h3>
                <form method="POST" action="#" enctype="multipart/form-data">
                @csrf
                    <textarea name="content" placeholder="Partager une idée, un service..." rows="3"
                              class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#569BAB] outline-none dark:bg-gray-700"></textarea>
                    <div class="flex gap-3 items-center">
                        <input type="file" name="image" accept="image/*" class="text-sm">
                        <button type="submit"
                                class="ml-auto px-4 py-2 bg-[#569BAB] text-white rounded-xl hover:bg-[#305F70] transition">
                            Publier
                        </button>
                    </div>
                </form>
            </div>

            <!-- FEED -->
            

        </main>

    </div>
</section>

@endsection