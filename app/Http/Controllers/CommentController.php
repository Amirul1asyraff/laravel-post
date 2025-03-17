<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{

    public function store(Request $request,Post $post)
    {
        // dd($request->all());
        $request->validate([
            'text' => 'required',
        ]);

        Comment::create([
            'user_id' => auth()->user()->id,
            'text' => $request->text,
            'post_id' => $post->id,
        ]);
        return redirect()->route('post.show' ,$post);

    }
}
