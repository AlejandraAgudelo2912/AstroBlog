<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class UserTagController extends Controller
{
    public function index()
    {
        $tags = Tag::latest()->paginate(10);
        return view('user.tags.index', compact('tags'));
    }

    public function show(Tag $tag)
    {
        $posts = $tag->posts()->where('status', 'published')->paginate(10);
        return view('user.tags.show', compact('tag', 'posts'));
    }
}
