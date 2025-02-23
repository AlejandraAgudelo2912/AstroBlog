<?php

use App\Models\Post;
use App\Models\Tag;

it('renders the index page with tags', function () {
    // Arrange
    Tag::factory()->count(3)->create();

    // Act
    $response = $this->get(route('tags.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('public.tags.index');
    $response->assertViewHas('tags');
});

it('renders the show page for a tag with published posts', function () {
    // Arrange
    $tag = Tag::factory()->create();
    $post = Post::factory()->create(['status' => 'published', 'visibility' => 'public']);
    $tag->posts()->attach($post); // Asociar el post con el tag

    // Act
    $response = $this->get(route('tags.show', $tag));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('public.tags.show');
    $response->assertViewHas(['tag', 'posts']);
});
