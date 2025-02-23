<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;

class AdminCommentController extends Controller
{
    use AuthorizesRequests;

    public function index(Post $post)
    {
        $this->authorize('viewAny', Comment::class);
        $comments = Comment::latest()->paginate(10);

        return view('admin.comments.index', compact('comments', 'post'));
    }

    public function show(Post $post, Comment $comment)
    {
        $this->authorize('view', $comment);

        return view('admin.comments.show', compact('comment', 'post'));
    }

    public function edit(Post $post, Comment $comment)
    {
        $this->authorize('update', $comment);

        return view('admin.comments.edit', compact('comment', 'post'));
    }

    public function update(Post $post, UpdateCommentRequest $request, Comment $comment)
    {
        $request->validated();

        $comment->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('admin.posts.comments.index', ['post' => $post])->with('success', 'Comentario actualizado correctamente.');
    }

    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return redirect()->route('admin.posts.comments.index', ['post' => $post])->with('success', 'Comentario eliminado correctamente.');
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

    public function create(Post $post, ?Comment $parent_id = null)
    {
        $this->authorize('create', Comment::class);

        return view('admin.comments.create', compact('post', 'parent_id'));
    }
}
