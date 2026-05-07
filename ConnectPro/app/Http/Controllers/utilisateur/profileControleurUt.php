<?php

namespace App\Http\Controllers\utilisateur;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Post;
use App\Models\Comment;


class profileControleurUt extends Controller
{

    public function index()
    {
        // dd('test');
        // exit();
        $user = Auth::user();
        $totalPosts = $user->posts()->count();
        $posts = Post::with(['user', 'comments.user'])
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);
        // return dd($user,$posts,$totalPosts);
        return view('utilisateur.profile', compact(
            'user',
            'posts',
            'totalPosts'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|max:2048',
            'name' => 'max:255',
            'city' => 'string|max:70',
            'phone' => 'required|string|max:20',
            'region'=> 'required|string|max:90',
            'adress'=> 'string|max:90',
        ]);

        $user = Auth::user();

        //photo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profiles', 'public');
            $user->photo = $path;
        }
        
        $user->name = $request->name;
        $user->city = $request->city;
        $user->phone = $request->phone;
        $user->region = $request->region;
        $user->adress = $request->adress;

        $user->save();

        return redirect()->route('dashboard')
            ->with('success', 'Profil professionnel complété !');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('utilisateur.updateProfile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|max:2048',
            'name' => 'max:255',
            'city' => 'string|max:70',
            'phone' => 'required|string|max:20',
            'region'=> 'required|string|max:90',
            'adress'=> 'string|max:90',
        ]);

        $user = Auth::user();
        $utilisateur = $user->client;

       
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profiles', 'public');
            $user->photo = $path;
        }

        //information pour user 
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->region = $request->region;
        $user->name = $request->name;
        $user->address = $request->address;

        $user->save();
  
        return back()->with('success', 'Profil mis à jour !');
    } 
    
}
