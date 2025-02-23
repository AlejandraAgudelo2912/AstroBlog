<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PageHomeController extends Controller
{
    public function index()
    {
        $topPosts = Post::topLiked(3)->get();

        return view('welcome', compact('topPosts'));
    }
}
