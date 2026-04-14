<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\Professionnel;
use App\Models\Spesiality;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
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

    public function edit()
    {
        $user = Auth::user();
        return view('profile.update_pr_pro', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|max:2048',
            'name' => 'max:255',
            'city' => 'string|max:70',
            'phone' => 'required|string|max:20',
            'category' => 'required|string|max:100',
            'speciality' => 'required|string|max:100',
            'bio' => 'required|string|max:500',
        ]);

        $user = Auth::user();
        $city = City::user();
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profiles', 'public');
            $user->photo = $path;
        }

        $user->phone = $request->phone;
        $user->category = $request->category;
        $user->speciality = $request->speciality;
        $user->bio = $request->bio;

        $user->save();

        dump($user);
        dump($city);

        return back()->with('success', 'Profil mis à jour !');
    }
}
