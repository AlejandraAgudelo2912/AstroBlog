<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function list()
    {
        $users = User::all();

        return view('admin.users.list', compact('users'));
    }
}
