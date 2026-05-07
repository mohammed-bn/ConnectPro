<?php

namespace App\Http\Controllers\utilisateur;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; 
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use App\models\DemandeConsultation;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    //client
    public function dashClient()
    {
        $posts = Post::with(['user', 'comments.user'])
                 ->latest()
                 ->paginate(10);
        $totalPosts = Post::where('user_id', Auth::id())->count();
        $toalDemendconsult = DemandeConsultation::where('professionnel_id',Auth::id())->count();
        return view('utilisateur.dashboard',compact('posts', 'totalPosts', 'toalDemendconsult'));
    }


   }
