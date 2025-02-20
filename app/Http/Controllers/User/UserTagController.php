<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserTagController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny', Tag::class);
        $tags = Tag::latest()->paginate(10);
        return view('user.tags.index', compact('tags'));
    }

    public function show(Tag $tag)
    {
        $this->authorize('view', $tag);
        $posts = $tag->posts()->where('status', 'published')->paginate(10);
        return view('user.tags.show', compact('tag', 'posts'));
    }
}
