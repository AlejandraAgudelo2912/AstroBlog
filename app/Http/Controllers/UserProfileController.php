<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserProfileController extends Controller
{
    public function show(User $user)
    {
        return view('user.profile', compact('user'));
    }

    public function byPosts(User $user)
    {
        $posts = $user->posts()->latest()->paginate(10);
        return view('user.byPosts', compact('user', 'posts'));
    }
}
