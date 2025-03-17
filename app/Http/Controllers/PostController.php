<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class PostController extends Controller
{

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }
    public function create()
    {
        return view("post.create");
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'caption' => 'required',
        ]);

        Post::create([
            'caption' => $request->caption,
            'user_id' => auth()->user()->id

        ]);
        return redirect()->route('home');

    }

    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'caption' => 'required',
        ]);

        $post->update([
            'caption' => $request->caption,
        ]);
        return redirect()->route('home');
    }
    public function destroy(Post $post)
    {
        // Delete related comments first
        $post->comments()->delete();
        
        // Then delete the post
        $post->delete();
        return back();
    }


}
