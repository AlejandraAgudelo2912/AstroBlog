<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        return TagResource::collection(Tag::all());
    }

    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    public function store(StoreTagRequest $request)
    {
        $request->validated();

        $slug = Str::slug($request->name);
        $tag = Tag::create([
            'slug' => $slug,
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tag creado correctamente.',
            'tag' => new TagResource($tag),
        ], Response::HTTP_CREATED);
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $request->validated();

        $slug = Str::slug($request->name);

        $tag->update([
            'slug' => $slug,
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tag actualizado correctamente.',
            'tag' => new TagResource($tag),
        ], Response::HTTP_OK);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tag eliminado correctamente.',
        ], Response::HTTP_OK);
    }
}
