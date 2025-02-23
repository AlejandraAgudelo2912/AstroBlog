<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\EonetService;
use App\Services\NasaService;

class PageHomeController extends Controller
{
    public function index()
    {
        $topPosts = Post::featured()->latest()->take(5)->get();

        return view('welcome', compact('topPosts'));
    }
}
