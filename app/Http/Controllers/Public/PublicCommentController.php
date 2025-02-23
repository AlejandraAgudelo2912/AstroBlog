<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;

class PublicCommentController extends Controller
{
    public function index(Post $post)
    {
        $comments = $post->comments()->latest()->paginate(10);

        return view('public.comments.index', compact('post', 'comments'));
    }

    public function show(Post $post, Comment $comment)
    {
        return view('public.comments.show', compact('post', 'comment'));
    }
}
