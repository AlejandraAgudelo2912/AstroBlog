<?php

use App\Models\Comment;
use App\Models\Post;

it('renders the index page with comments for a post', function () {
    // Arrange
    $post = Post::factory()->create();
    Comment::factory()->count(3)->create(['post_id' => $post->id]);

    // Act
    $response = $this->get(route('posts.comments.index', $post));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('public.comments.index');
    $response->assertViewHas(['post', 'comments']);
});

it('renders the show page for a specific comment', function () {
    // Arrange
    $post = Post::factory()->create();
    $comment = Comment::factory()->create(['post_id' => $post->id]);

    // Act
    $response = $this->get(route('posts.comments.show', ['post' => $post, 'comment' => $comment]));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('public.comments.show');
    $response->assertViewHas(['post', 'comment']);
});
