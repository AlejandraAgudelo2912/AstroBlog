<?php

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->user->assignRole('user');
    $this->actingAs($this->user);
});

it('renders the index page', function () {
    // Arrange
    Tag::factory()->count(3)->create();

    // Act
    $response = $this->get(route('user.tags.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.tags.index');
    $response->assertViewHas('tags');
});

it('renders the show page for a tag with published posts', function () {
    // Arrange
    $tag = Tag::factory()->create();
    $post = Post::factory()->create(['status' => 'published']);
    $tag->posts()->attach($post);

    // Act
    $response = $this->get(route('user.tags.show', $tag));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.tags.show');
    $response->assertViewHas(['tag', 'posts']);
});
