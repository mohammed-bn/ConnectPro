@extends('layouts.app')

@section('title', 'Modifier Profil')

@section('content')

<div class="min-h-screen bg-gray-100 dark:bg-slate-900 py-10">

    <div class="max-w-4xl mx-auto bg-white dark:bg-slate-800 shadow-xl rounded-2xl p-8">

        <h2 class="text-2xl font-bold text-slate-800 dark:text-white mb-6">
            Modifier votre profil
        </h2>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT') 
            

            <!-- PHOTO -->
            <div class="flex items-center gap-6">
                <img 
                    id="preview"
                    src="{{ $user->photo ? asset('storage/'.$user->photo) : 'https://cdn-icons-png.flaticon.com/512/1077/1077063.png' }}"
                    class="w-24 h-24 rounded-full border-4 border-blue-500 object-cover">

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Changer la photo
                    </label>
                    <input type="file" name="photo" id="photo"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                               file:rounded-lg file:border-0 file:bg-blue-600 file:text-white
                               hover:file:bg-blue-700">
                    @error('photo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- GRID -->
            <div class="grid md:grid-cols-2 gap-6">

                <!-- PHONE -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
                        Nom
                    </label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-3
                               focus:ring-2 focus:ring-blue-500 outline-none dark:bg-slate-700 dark:text-white">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
                        Téléphone
                    </label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-3
                               focus:ring-2 focus:ring-blue-500 outline-none dark:bg-slate-700 dark:text-white">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
                        Région
                    </label>
                    <input type="text" name="phone" value="{{ old('region', $user->region) }}"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-3
                               focus:ring-2 focus:ring-blue-500 outline-none dark:bg-slate-700 dark:text-white">
                    @error('region')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
                        Ville
                    </label>
                    <input type="text" name="city" value="{{ old('city', $user->city) }}"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-3
                               focus:ring-2 focus:ring-blue-500 outline-none dark:bg-slate-700 dark:text-white">
                    @error('city')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
                        Adresse
                    </label>
                    <input type="text" name="address" value="{{ old('address', $user->address) }}"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-3
                               focus:ring-2 focus:ring-blue-500 outline-none dark:bg-slate-700 dark:text-white">
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- CATEGORY -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
                        Catégorie
                    </label>
                    <input type="text" name="category" value="{{ old('category', $user->category) }}"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-3
                               focus:ring-2 focus:ring-blue-500 outline-none dark:bg-slate-700 dark:text-white">
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- SPECIALITY -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
                        Spécialité
                    </label>
                    <input type="text" name="speciality" value="{{ old('speciality', $user->speciality) }}"
                        class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-3
                               focus:ring-2 focus:ring-blue-500 outline-none dark:bg-slate-700 dark:text-white">
                    @error('speciality')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- EMAIL (readonly) -->
                <div>
                    <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <input type="email" value="{{ $user->email }}" disabled
                        class="w-full border border-gray-200 rounded-xl p-3 bg-gray-100 text-gray-500 cursor-not-allowed">
                </div>

            </div>

            <!-- BIO -->
            <div>
                <label class="block mb-1 font-semibold text-gray-700 dark:text-gray-300">
                    Bio
                </label>
                <textarea name="bio" rows="4"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-3
                           focus:ring-2 focus:ring-blue-500 outline-none dark:bg-slate-700 dark:text-white">{{ old('bio', $user->bio) }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- BUTTON -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded-xl shadow hover:bg-blue-700 transition">
                    💾 Enregistrer les modifications
                </button>
            </div>

        </form>

    </div>

</div>

<!-- Preview image JS -->
<script>
    const photoInput = document.getElementById('photo');
    const previewImg = document.getElementById('preview');

    photoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if(file){
            previewImg.src = URL.createObjectURL(file);
        }
    });
</script>

@endsection