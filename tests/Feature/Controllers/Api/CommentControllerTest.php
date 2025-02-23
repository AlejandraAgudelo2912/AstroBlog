<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Response;

it('returns a specific comment', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $post = Post::factory()->create();
    $comment = Comment::factory()->create(['post_id' => $post->id, 'user_id' => $user->id]);

    // Act
    $response = $this->getJson(route('api.posts.comments.show', ['post' => $post->id, 'comment' => $comment->id]));

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'data' => [
                'id' => $comment->id,
                'title' => $comment->title,
                'slug' => $comment->slug,
                'body' => $comment->body,
                'post_id' => $post->id,
                'user_id' => $comment->user_id,
            ]
        ]);
});

it('creates a new comment', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $post = Post::factory()->create();
    $data = [
        'title' => 'New Comment',
        'body' => 'This is a test comment',
        'post_id' => $post->id
    ];

    // Act
    $response = $this->postJson(route('api.posts.comments.store'), $data);

    // Assert
    $response->assertStatus(Response::HTTP_CREATED)
        ->assertJson([
            'success' => true,
            'message' => 'Comentario creado correctamente.',
            'comment' => [
                'title' => 'New Comment',
                'body' => 'This is a test comment'
            ]
        ]);

    $this->assertDatabaseHas('comments', ['title' => 'New Comment']);
})->skip('No se puede crear un comentario sin autenticación.');

it('updates an existing comment', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $post = Post::factory()->create();
    $comment = Comment::factory()->create(['post_id' => $post->id, 'user_id' => $user->id]);

    $data = ['title' => 'Updated Comment Title', 'body' => 'Updated body content'];

    // Act
    $response = $this->putJson(route('api.posts.comments.update', ['post' => $post->id, 'comment' => $comment->id]), $data);

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'success' => true,
            'message' => 'Comentario actualizado correctamente.',
            'comment' => ['title' => 'Updated Comment Title']
        ]);

    $this->assertDatabaseHas('comments', ['id' => $comment->id, 'title' => 'Updated Comment Title']);
});

it('deletes a comment', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $post = Post::factory()->create();
    $comment = Comment::factory()->create(['post_id' => $post->id, 'user_id' => $user->id]);

    // Act
    $response = $this->deleteJson(route('api.posts.comments.destroy', ['post' => $post->id, 'comment' => $comment->id]));

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'success' => true,
            'message' => 'Comentario eliminado correctamente.'
        ]);

    $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
})->skip('No se puede eliminar un comentario sin autenticación.');
