<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;

class UserCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('user.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('user.categories.show', compact('category'));
    }
}
