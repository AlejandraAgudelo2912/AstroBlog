<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserCommentController extends Controller
{
    use AuthorizesRequests;
    public function index(Post $post)
    {
        $comments = auth()->user()->comments()->get();
        return view('user.posts.show', compact('comments', 'post'));
    }

    public function show(Post $post, Comment $comment)
    {
        $this->authorize('view', $comment);

        return view('user.comments.show', compact('comment', 'post'));
    }

    public function create(Post $post)
    {
        $this->authorize('create', Comment::class);
        return view('user.comments.create', compact('post'));
    }

    public function store(StoreCommentRequest $request, Post $post)
    {
        $request->validated();

        $slug = Str::slug($request->title);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'title' => $request->title,
            'slug' => $slug,
            'body' => $request->body,
        ]);

        return redirect()->route('user.posts.comments.index', $post)->with('success', 'Comentario agregado.');
    }

    public function edit(Post $post, Comment $comment)
    {
        $this->authorize('update', $comment);

        return view('user.comments.edit', compact('comment', 'post'));
    }

    public function update(Post $post, UpdateCommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validated();

        $comment->update(['body' => $request->body]);

        return redirect()->route('user.posts.comments.index', ['post' => $post])->with('success', 'Comentario actualizado.');
    }

    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('user.posts.comments.index', ['post' => $post])->with('success', 'Comentario eliminado.');
    }

    public function reply(StoreCommentRequest $request, Post $post, Comment $comment)
    {
        $slug = Str::slug($request->title);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'title' => $request->title,
            'slug' => $slug,
            'body' => $request->body,
            'parent_id' => $comment->id,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Respuesta agregada correctamente');
    }

    public function replied(Post $post, Comment $comment)
    {
        return view('user.comments.reply', compact('post', 'comment'));
    }
}
