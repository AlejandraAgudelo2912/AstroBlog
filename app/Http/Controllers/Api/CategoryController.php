<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'categories' => Category::all()
        ], Response::HTTP_OK);
    }

    public function show(Category $category)
    {
        return response()->json([
            'success' => true,
            'category' => $category
        ], Response::HTTP_OK);
    }


    public function store(StoreCategoryRequest $request)
    {
        $request->validated();

        $slug = str()->slug($request->name);

        $category = Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Categoría creada correctamente.',
            'category' => $category
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $request->validated();

        $category->update([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Categoría actualizada correctamente.',
            'category' => $category
        ], Response::HTTP_OK);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Categoría eliminada correctamente.'
        ], Response::HTTP_OK);
    }
}
