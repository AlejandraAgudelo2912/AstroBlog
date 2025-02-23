<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CommentController extends Controller
{
    public function index($post_id)
    {
        $post = Post::where('id', $post_id)->first();

        if (!$post) {
            return response()->json([
                'message' => 'El post especificado no existe en la base de datos.'
            ], Response::HTTP_NOT_FOUND);
        }

        Comment::where('post_id', $post_id)->get();

        return CommentResource::collection($post->comments);
    }

    public function show($post,$id)
    {
        $comment = Comment::where('post_id', $post)
            ->where('id', $id)
            ->firstOrFail();

        return new CommentResource($comment);
    }

    public function store(StoreCommentRequest $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'No estás autenticado.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $postExists = Post::where('id', $request->post)->exists();
        if (!$postExists) {
            return response()->json([
                'message' => 'El post especificado no existe.'
            ], Response::HTTP_NOT_FOUND);
        }

        $slug = Str::slug($request->title);
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $request->post,
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $slug
        ]);

        $comment->load(['user:id,name', 'post:id,title']);

        return response()->json([
            'success' => true,
            'message' => 'Comentario creado correctamente.',
            'comment' => new CommentResource($comment)
        ], Response::HTTP_CREATED);
    }
    public function update(UpdateCommentRequest $request, $post_id, $comment_id)
    {
        $comment = Comment::where('post_id', $post_id)->where('id', $comment_id)->first();

        if (!$comment) {
            return response()->json([
                'message' => 'El comentario especificado no existe en este post.'
            ], Response::HTTP_NOT_FOUND);
        }

        if ($comment->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'No tienes permiso para editar este comentario.'
            ], Response::HTTP_FORBIDDEN);
        }

        $request->validated();

        $comment->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'body' => $request->body
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comentario actualizado correctamente.',
            'comment' => new CommentResource($comment)
        ], Response::HTTP_OK);
    }

    public function destroy(UpdateCommentRequest $request, $post_id, $comment_id)
    {
        $comment = Comment::where('post_id', $post_id)->where('id', $comment_id)->first();
        if ($comment->user_id !== auth()->id() && !auth()->user()->hasRole('admin')) {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permiso para eliminar este comentario.'
            ], Response::HTTP_FORBIDDEN);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comentario eliminado correctamente.'
        ], Response::HTTP_OK);
    }
}
