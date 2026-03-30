@extends('layouts.app')

@section('title', 'Connexion')

@section('content')

<section class="h-screen w-full flex items-center justify-center bg-gray-100 dark:bg-gray-900">

    <!-- CONTAINER -->
    <div class="w-full max-w-6xl grid md:grid-cols-2 gap-8 p-6">

        <!-- LEFT IMAGE CARD -->
        <div class="hidden md:flex items-center justify-center">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 w-full flex items-center justify-center animate-image">
                
                <img src="https://images.openai.com/static-rsc-4/9PuiiLDc3-9zbthqQdQzwELK2NGk-gKF08TID8-yg7iKBq5h7_s3bff6HhDdqkInpcej1cAQGCMwFu8QIBUKqMkCVlabLt4-ttaCE3fW5lDS3HVCAJx-TNoPvWKpOiJ4dpJ5rtem5_K3mQ3KqKzcvT1ozXG3kFKCuxqOXfF0cqd86jRmxtcV37tNcgfRl_4U?purpose=fullsize"
                     alt="Login illustration"
                     class="w-[70%] max-w-sm">
                     
            </div>
        </div>

        <!-- RIGHT FORM CARD -->
        <div class="flex items-center justify-center">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-10 w-full max-w-md animate-form">

                <h2 class="text-3xl font-bold text-[#569BAB] mb-6 text-center">
                    Connectez-vous
                </h2>

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- EMAIL -->
                    <input type="email" name="email" placeholder="Email"
                           class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#569BAB] outline-none"
                           required autofocus>

                    <!-- PASSWORD -->
                    <input type="password" name="password" placeholder="Mot de passe"
                           class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-[#569BAB] outline-none"
                           required>

                    <!-- REMEMBER ME -->
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-[#569BAB]">
                            Se souvenir de moi
                        </label>
                        <a href="{{ route('password.request') }}" class="text-[#569BAB] hover:text-[#305F70]">
                            Mot de passe oublié ?
                        </a>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                            class="w-full bg-[#569BAB] text-white p-3 rounded-xl shadow-lg hover:bg-[#305F70] transition transform hover:scale-105">
                        🔐 Se connecter
                    </button>

                </form>

                <p class="mt-4 text-center text-gray-600 dark:text-gray-300">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}" class="text-[#569BAB] font-semibold hover:text-[#305F70]">
                        Inscription
                    </a>
                </p>

            </div>

        </div>

    </div>

</section>

@endsection