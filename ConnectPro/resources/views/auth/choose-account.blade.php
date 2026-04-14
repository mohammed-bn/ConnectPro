@extends('layouts.app')

@section('title', 'Choisir votre compte')

@section('content')

<section class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900 px-6">

    <div class="max-w-5xl w-full text-center">

        <!-- HEADER -->
        <div class="mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-[#569BAB] mb-4">
                Complétez votre profil
            </h1>

            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                Choisissez votre type de compte pour continuer.
            </p>
        </div>

        <!-- CARDS -->
        <div class="grid md:grid-cols-2 gap-8">

            <!-- PROFESSIONNEL -->
            <form method="POST" action="{{ route('choose-account.store') }}">
                @csrf
                <input type="hidden" name="account_type" value="professional">

                <button type="submit"
                        class="group w-full p-8 rounded-2xl bg-white dark:bg-gray-800 shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">

                    <div class="flex flex-col items-center text-center">

                        <div class="bg-[#9EBFAD] p-5 rounded-full mb-6 group-hover:scale-110 transition">
                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                                 class="w-16">
                        </div>

                        <h2 class="text-2xl font-bold text-[#305F70] mb-3">
                            Professionnel
                        </h2>

                        <p class="text-gray-600 dark:text-gray-300 mb-6">
                            Publiez vos services et développez votre activité.
                        </p>

                        <span class="text-[#569BAB] font-semibold group-hover:underline">
                            Continuer →
                        </span>

                    </div>

                </button>
            </form>


            <!-- CLIENT -->
            <form method="POST" action="{{ route('choose-account.store') }}">
                @csrf
                <input type="hidden" name="account_type" value="client">

                <button type="submit"
                        class="group w-full p-8 rounded-2xl bg-white dark:bg-gray-800 shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2">

                    <div class="flex flex-col items-center text-center">

                        <div class="bg-[#9EBFAD] p-5 rounded-full mb-6 group-hover:scale-110 transition">
                            <img src="https://cdn-icons-png.flaticon.com/512/1077/1077063.png"
                                 class="w-16">
                        </div>

                        <h2 class="text-2xl font-bold text-[#305F70] mb-3">
                            Client
                        </h2>

                        <p class="text-gray-600 dark:text-gray-300 mb-6">
                            Trouvez facilement les meilleurs professionnels.
                        </p>

                        <span class="text-[#569BAB] font-semibold group-hover:underline">
                            Continuer →
                        </span>

                    </div>

                </button>
            </form>

        </div>

    </div>

</section>

@endsection