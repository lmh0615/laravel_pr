<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CommentController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required',
        ]);
    
        $comment = new Comment;
        $comment->user_id = Auth::id();
        $comment->post_id = $post->id;
        $comment->body = $request->body;
        $comment->save();
    
        return back();
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
