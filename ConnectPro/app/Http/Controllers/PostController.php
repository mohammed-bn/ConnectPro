<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{


    //ajouter un publication
    public function store(Request $request)
    {
        // return dd('kaywsal function');
        // exit();

        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:5000',
        ]);

        try {

            $imagePath = null;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('posts', 'public');
            }

            Post::create([
                'image' => $imagePath,
                'description' => $validated['description'],
                'user_id' => Auth::id(),
            ]);

            return redirect()->back()->with('success', 'Publication créée avec succès');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Erreur lors de la création');

        }
    }
 
    


    
    public function userPosts($userId)
    {
        $user = User::findOrFail($userId);

        $posts = Post::with(['user', 'comments.user'])
                    ->where('user_id', $userId)
                    ->latest()
                    ->paginate(10);

        return view('voirProfile', compact('user', 'posts'));
    }


    public function myPosts()
    {
        // return dd('hawil hawil ');
            // exit();
        $user = Auth::user();

        $posts = Post::with(['user', 'comments.user'])
                    ->where('user_id', $user->id)
                    ->latest()
                    ->paginate(10);

        return view('utilisateur.profil', compact('posts'));
    }
 
}