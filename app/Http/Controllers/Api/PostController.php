<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        return response()->json(Post::publicados()->get(), 200);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return new PostResource($post);
    }

    public function store(StorePostRequest $request)
    {
        $user = auth()->user();

        if (! $user->tokenCan('create-posts') && ! $user->tokenCan('*')) {
            return response()->json(['error' => 'No tienes permisos para crear posts'], 403);
        }
        $request->validated();

        $slug = Str::slug($request->title);

        $post = Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'body' => $request->body,
            'published_at' => $request->published_at,
            'visibility' => $request->visibility,
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'status' => 'draft',
        ]);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return response()->json([
            'message' => 'Post creado con éxito',
            'post' => new PostResource($post),
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $user = auth()->user();
        if (! $user->tokenCan('edit-own-posts') || ($user->id !== $post->user_id && ! $user->tokenCan('*'))) {
            return response()->json(['error' => 'No tienes permisos para editar este post'], 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:public,draft,archived',
            'visibility' => 'sometimes|required|in:public,private',
            'published_at' => 'sometimes|nullable|date',
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        if ($request->filled('title')) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $post->update($validated);

        return response()->json([
            'message' => 'Post actualizado con éxito',
            'post' => new PostResource($post->refresh()),
        ]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $user = auth()->user();

        if (! $user->tokenCan('delete-own-posts') || ($user->id !== $post->user_id && ! $user->tokenCan('*'))) {
            return response()->json(['error' => 'No tienes permisos para eliminar este post'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Post eliminado'], 200);
    }

    public function findById($id)
    {
        $post = Post::findOrFail($id);

        return response()->json($post);
    }
}
