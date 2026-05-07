<?php

namespace App\Http\Controllers\professionnel;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 
use Illuminate\Support\Facades\Auth;
use App\Models\Professionnel;
use App\Models\Speciality;
use App\Models\Post;
use App\Models\Comment;


class ProfileControllerPr extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $totalPosts = $user->posts()->count();
        $posts = Post::with(['user', 'comments.user'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);
        
        return view('professionnel.profile', compact(
            'user',
            'posts',
            'totalPosts'
        ));
        // return dd($user,'tesst');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|max:2048',
            'phone' => 'string|max:20',
            'category' => 'string|max:100',
            'speciality' => 'string|max:100',
            'bio' => 'string|max:500',
        ]);

        $user = Auth::user();

        //photo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profiles', 'public');
            $user->photo = $path;
        }

        $user->phone = $request->phone;
        $user->speciality = $request->speciality;
        $user->bio = $request->bio;

        $user->save();

        return redirect()->route('professionnel.dashboard')
            ->with('success', 'Profil professionnel complété !');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('professionnel.updateProfile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|max:2048',
            'name' => 'nullable|max:255',
            'city' => 'nullable|string|max:70',
            'phone' => 'nullable|string|max:20',
            'region' => 'nullable|string|max:90',
            'address' => 'nullable|string|max:90',
            'category' => 'nullable|string|max:100',
            'speciality' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $pro = $user->professionnel;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profiles', 'public');
            $user->photo = $path;
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->region = $request->region;
        $user->address = $request->address;
        $pro->category = $request->category;
        if ($request->speciality) {
            $speciality = Speciality::firstOrCreate(['title' => $request->speciality]);
            $pro->speciality_id = $speciality->id;
        }
        $pro->bio = $request->bio;

        $user->save();
        $pro->save();

        return back()->with('success', 'Profil mis à jour avec succès !');
    }

    public function voirProfile($id)
    {
        $professionnel = Professionnel::with('user', 'specialty')
            ->findOrFail($id);

        return view('voirProfile', compact('professionnel'));
    }
}
