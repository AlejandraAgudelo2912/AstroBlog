<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

class AdminTagController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny', Tag::class);
        $tags = Tag::latest()->paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    public function show(Tag $tag)
    {
        $this->authorize('view', $tag);
        return view('admin.tags.show', compact('tag'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        $request->validated();

        Tag::create($request->only('name'));

        return redirect()->route('admin.tags.index')->with('success', 'Etiqueta creada correctamente.');
    }

    public function edit(Tag $tag)
    {
        $this->authorize('update', $tag);
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $request->validated();
        $tag->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.tags.index')->with('success', 'Etiqueta actualizada correctamente.');
    }

    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('success', 'Etiqueta eliminada correctamente.');
    }
}
