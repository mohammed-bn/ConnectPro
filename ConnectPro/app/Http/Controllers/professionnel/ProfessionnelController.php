<?php

namespace App\Http\Controllers\professionnel;

use App\Models\Professionnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Post;
use App\Http\Controllers\Controller;

class ProfessionnelController extends Controller
{

    public function dashProfessionell()
    {
        $posts = Post::with(['user', 'comments.user'])
                 ->latest()
                 ->paginate(10);
        return view('professionnel.dashboard', compact('posts'));
    }

    public function store(Request $request, $userId)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'bio'      => 'required|string|max:550',
            'specialty_id'  => 'required|specialties,id',
        ]);

        $user = User::create([
            'category' => $request->category,
            'bio'      => $request->bio,
            'user_id' => $userId,
        ]);
    }

    public function show($id)
    {
        $user = User::with(['professionnel.specialty'])->findOrFail($id);
        
        $posts = Post::with(['user', 'comments.user'])
                    ->where('user_id', $id)
                    ->latest()
                    ->paginate(10);
        
        $totalPost = $posts->total();
        
        $consultationsCount = 0;
        
        $existingRequest = null;
        

        $isClient = Auth::check() && !Auth::user()->professionnel;
        
    
        return view('voirProfile', compact(
            'user',         
            'posts',        
            'totalPost',
            'consultationsCount',
            'isClient',
            'existingRequest'
        ));
    }


}
