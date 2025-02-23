<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PublicPostController extends Controller
{
    public function index()
    {
        $posts = Post::publicados()->latest()->paginate(10);

        return view('public.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        if ($post->visibility === 'private') {
            abort(403, 'No tienes permiso para ver este post.');
        }

        return view('public.posts.show', compact('post'));
    }
}
