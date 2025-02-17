<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

beforeEach(function () {
    Gate::shouldReceive('authorize')->andReturn(true);
});

it('creates a post successfully', function () {
    //Arrange
    $user = User::factory()->create();
    $this->actingAs($user);

    //Act
    $response = $this->post(route('posts.store'), [
        'title' => 'Test Post',
        'body' => 'This is a test post.',
        'category_id' => Category::factory()->create()->id,
        'published_at' => now(),
        'status' => 'published',
        'visibility' => 'public',
    ]);

    //Assert
    $response->assertRedirect(route('posts.index'));
    $this->assertDatabaseHas('posts', [
        'user_id' => $user->id,
        'title' => 'Test Post',
        'body' => 'This is a test post.',
    ]);

});

it('updates a post successfully', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user);

    $post = Post::factory()->create(['user_id' => $user->id]);

    $updatedData = [
        'title' => 'Updated title',
        'body' => $post->body,
        'category_id' => $post->category_id,
        'published_at' =>now(),
        'status' => $post->status,
        'visibility' => $post->visibility,
    ];

    // Act
    $response = $this->put(route('posts.update', $post), $updatedData);

    // Assert
    $response->assertRedirect(route('posts.index'));
    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => $updatedData['title'],
    ]);
});

it('deletes a post successfully', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user);

    $post = Post::factory()->create(['user_id' => $user->id]);

    // Act
    $response = $this->delete(route('posts.destroy', $post));

    // Assert
    $response->assertRedirect(route('posts.index'));
    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
    ]);
});
