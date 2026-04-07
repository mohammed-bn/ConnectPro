@extends('layouts.app')

@section('title', 'Profil Pro')

@section('content')

<div class="min-h-screen bg-gray-100 dark:bg-slate-900 py-6">

    <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-6 px-6">

        <!-- LEFT PANEL -->
        <aside class="hidden md:flex flex-col gap-6">

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow p-6 text-center">

                <img src="{{ $user->photo ?? 'https://cdn-icons-png.flaticon.com/512/1077/1077063.png' }}"
                     class="w-24 h-24 rounded-full mx-auto mb-3 border-4 border-blue-500">

                <h2 class="text-xl font-bold text-slate-800 dark:text-white mb-1">{{ $user->name }}</h2>
                <p class="text-gray-500 dark:text-gray-300">{{ $user->speciality ?? 'Spécialité non définie' }}</p>
                <p class="text-gray-500 dark:text-gray-300">{{ $user->city ?? 'Ville non définie' }}</p>

                <a href="{{ route('profile.update') }}"
                   class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-xl hover:bg-blue-700 transition">
                    Modifier Profil
                </a>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow p-4 text-slate-600 dark:text-gray-300">
                <h3 class="font-bold mb-3 text-slate-800 dark:text-white">Invitations / Demandes</h3>

                @forelse($user->invitations ?? [] as $inv)
                    <div class="flex justify-between mb-2">
                        <span>{{ $inv->client->name ?? 'Utilisateur' }}</span>
                        <div class="flex gap-2">
                            <button class="text-green-500 hover:underline">Accepter</button>
                            <button class="text-red-500 hover:underline">Refuser</button>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Pas d'invitations pour le moment.</p>
                @endforelse
            </div>

        </aside>

        <!-- MAIN PANEL (Publications + Bio) -->
        <main class="md:col-span-2 space-y-6">

            <!-- BIO / INFO -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow p-6">
                <h3 class="font-bold text-lg mb-3 text-slate-800 dark:text-white">À propos</h3>
                <p class="text-gray-600 dark:text-gray-300">{{ $user->bio ?? 'Pas de description pour le moment.' }}</p>

                <div class="mt-4 grid md:grid-cols-2 gap-4 text-gray-700 dark:text-gray-300">
                    <p><strong>Téléphone:</strong> {{ $user->phone ?? 'Non défini' }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Catégorie:</strong> {{ $user->category ?? 'Non défini' }}</p>
                    <p><strong>Spécialité:</strong> {{ $user->speciality ?? 'Non défini' }}</p>
                    <p><strong>Ville:</strong> {{ $user->city ?? 'Non défini' }}</p>
                    <p><strong>Région:</strong> {{ $user->region ?? 'Non défini' }}</p>
                </div>
            </div>

            <!-- PUBLICATIONS -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow p-6 space-y-4 overflow-y-auto max-h-[70vh] no-scrollbar">
                <h3 class="font-bold text-lg text-slate-800 dark:text-white mb-4">Publications</h3>

                @for($i=0; $i<5; $i++)
                <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                    <div class="flex items-center gap-3 mb-2">
                        <img src="{{ $user->photo ?? 'https://cdn-icons-png.flaticon.com/512/1077/1077063.png' }}"
                             class="w-10 h-10 rounded-full">
                        <div>
                            <h4 class="font-bold text-slate-800 dark:text-white">{{ $user->name }}</h4>
                            <p class="text-sm text-gray-500">Il y a 2h</p>
                        </div>
                    </div>

                    <p class="text-gray-600 dark:text-gray-300 mb-2">
                        Exemple de contenu de publication professionnel. Vous pouvez partager vos offres, conseils ou informations.
                    </p>

                    <div class="flex gap-3 text-sm text-gray-500">
                        <button class="hover:text-blue-500">👍 Like</button>
                        <button class="hover:text-blue-500">💬 Comment</button>
                        <button class="hover:text-blue-500">📤 Partager</button>
                    </div>
                </div>
                @endfor

            </div>

        </main>

    </div>

</div>

@endsection