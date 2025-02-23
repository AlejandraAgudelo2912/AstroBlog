<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserCategoryController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Category::class);
        $categories = Category::latest()->paginate(10);

        return view('user.categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $this->authorize('view', $category);

        return view('user.categories.show', compact('category'));
    }
}
