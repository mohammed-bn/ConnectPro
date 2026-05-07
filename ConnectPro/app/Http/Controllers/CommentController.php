<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function creatComent(Post $post,Request $request){
        $request->validate([
            'content' => 'required|string|max:255'
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'user_id' => auth()->id(), 
            'post_id' => $post->id
            ]);
        
        return redirect()->back()->with('success', 'Commentaire créée avec succès');
    }
}
