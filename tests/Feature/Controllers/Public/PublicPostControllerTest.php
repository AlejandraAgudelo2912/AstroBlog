<?php

use App\Models\Post;

it('renders the index page with published posts', function () {
    // Arrange
    Post::factory()->count(3)->create(['status' => 'published', 'visibility' => 'public']);

    // Act
    $response = $this->get(route('posts.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('public.posts.index');
    $response->assertViewHas('posts');
});

it('renders the show page for a public post', function () {
    // Arrange
    $post = Post::factory()->create(['status' => 'published', 'visibility' => 'public']);

    // Act
    $response = $this->get(route('posts.show', $post));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('public.posts.show');
    $response->assertViewHas('post', $post);
});

it('returns 403 when trying to view a private post', function () {
    // Arrange
    $post = Post::factory()->create(['status' => 'published', 'visibility' => 'private']);

    // Act
    $response = $this->get(route('posts.show', $post));

    // Assert
    $response->assertStatus(403);
    $response->assertSee('No tienes permiso para ver este post.');
});
