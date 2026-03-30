<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompleteProfileController extends Controller
{
    /**
     * Afficher formulaire professionnel
     */
    public function index()
    {
        return view('complete-profile');
    }

    /**
     * Enregistrer les infos du profil
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|max:2048',
            'phone' => 'required|string|max:20',
            'category' => 'required|string|max:100',
            'speciality' => 'required|string|max:100',
            'bio' => 'required|string|max:500',
        ]);

        $user = Auth::user();

        // Upload photo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profiles', 'public');
            $user->photo = $path;
        }

        $user->phone = $request->phone;
        $user->category = $request->category;
        $user->speciality = $request->speciality;
        $user->bio = $request->bio;

        $user->save();

        return redirect()->route('dashboard')
            ->with('success', 'Profil professionnel complété !');
    }
}