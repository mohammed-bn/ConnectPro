@extends('layouts.app')

@section('title', 'Inscription')

@section('content')

<section class="h-screen w-full flex items-center justify-center bg-gray-100 dark:bg-gray-900">

    <!-- CONTAINER -->
    <div class="w-full max-w-6xl grid md:grid-cols-2 gap-8 p-6">

        <!-- LEFT IMAGE CARD -->
        <div class="hidden md:flex items-center justify-center">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 w-full flex items-center justify-center">
                
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                     alt="Register illustration"
                     class="w-[70%] max-w-sm">

            </div>
        </div>

        <!-- RIGHT FORM CARD -->
        <div class="flex items-center justify-center">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-10 w-full max-w-md">

                <h2 class="text-3xl font-bold text-[#569BAB] mb-6 text-center">
                    Créez votre compte
                </h2>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- NAME -->
                    <input type="text" name="name" placeholder="Nom complet"
                           class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#569BAB] outline-none">

                    <!-- EMAIL -->
                    <input type="email" name="email" placeholder="Email"
                           class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#569BAB] outline-none">

                    <!-- PASSWORD -->
                    <input type="password" name="password" placeholder="Mot de passe"
                           class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#569BAB] outline-none">

                    <!-- CONFIRM -->
                    <input type="password" name="password_confirmation" placeholder="Confirmer mot de passe"
                           class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#569BAB] outline-none">

                    <!-- BUTTON -->
                    <button type="submit"
                            class="w-full bg-[#569BAB] text-white p-3 rounded-xl shadow-lg hover:bg-[#305F70] transition transform hover:scale-105">
                        🚀 S'inscrire
                    </button>

                </form>

                <p class="mt-4 text-center text-gray-600 dark:text-gray-300">
                    Déjà un compte ?
                    <a href="{{ route('login') }}" class="text-[#569BAB] font-semibold hover:text-[#305F70]">
                        Connexion
                    </a>
                </p>

            </div>

        </div>

    </div>

</section>

@endsection