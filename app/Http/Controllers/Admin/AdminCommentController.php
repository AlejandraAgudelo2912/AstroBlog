<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Str;

class AdminCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    public function show(Comment $comment)
    {
        return view('admin.comments.show', compact('comment'));
    }

    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment->update([
            'body' => $request->body,
        ]);

        return redirect()->route('admin.comments.index')->with('success', 'Comentario actualizado correctamente.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index')->with('success', 'Comentario eliminado correctamente.');
    }

    public function store(StoreCommentRequest $request, Post $post)
    {
        $slug = Str::slug($request->title);

        $parent_id = $request->input('parent_id');

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'title' => $request->title,
            'slug' => $slug,
            'body' => $request->body,
            'parent_id' => $parent_id,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment created successfully');
    }

    public function create(Post $post, Comment $parent_id)
    {
        return view('comments.create', compact('post', 'parent_id'));
    }

}
