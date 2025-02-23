<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;

class PublicCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('public.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        return view('public.categories.show', compact('category'));
    }
}
