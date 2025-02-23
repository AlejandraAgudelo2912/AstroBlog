<?php

use App\Models\Post;

it('loads Post page successfully', function () {
    // Arrange
    $response = $this->get('/posts');
    // Act & Assert
    $response->assertStatus(200);
});

it('shows all posts published and public', function () {
    // Arrange
    $post = Post::factory(3)->create(['status' => 'published', 'visibility' => 'public']);
    $response = $this->get('/posts');

    // Act & Assert
    $response->assertSee($post[0]->title)
        ->assertSee($post[1]->title)
        ->assertSee($post[2]->title);
});

it('does not show unpublished posts and private', function () {
    // Arrange
    $post = Post::factory()->create(['status' => 'draft', 'visibility' => 'public']);
    $post2 = Post::factory()->create(['status' => 'published', 'visibility' => 'public']);
    $post3 = Post::factory()->create(['status' => 'published', 'visibility' => 'private']);

    $response = $this->get('/posts');

    // Act & Assert
    $response->assertDontSee($post->title)
        ->assertSee($post2->title)
        ->assertDontSee($post3->title);
});
