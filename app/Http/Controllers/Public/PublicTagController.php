<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class PublicTagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return view('public.tags.index', compact('tags'));
    }

    public function show(Tag $tag)
    {
        $posts = $tag->posts()->publicados()->latest()->paginate(10);

        return view('public.tags.show', compact('tag', 'posts'));
    }
}
