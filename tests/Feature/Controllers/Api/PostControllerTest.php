<?php

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user, 'sanctum');
    $this->user->syncRoles('admin');
});

it('returns all published posts', function () {
    // Arrange
    Post::factory()->count(3)->create(['status' => 'public']);

    // Act
    $response = $this->getJson(route('api.posts.index'));

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            '*' => ['id', 'title', 'slug', 'body', 'published_at', 'visibility']
        ]);
});

it('returns a specific post', function () {
    // Arrange
    $post = Post::factory()->create();

    // Act
    $response = $this->getJson(route('api.posts.show', ['post' => $post]));

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'data' => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'body' => $post->body,
            ]
        ]);
});

it('creates a new post', function () {
    // Arrange
    $category = Category::factory()->create();

    $data = [
        'title' => 'New Post',
        'body' => 'This is a test post',
        'published_at' => now()->toDateString(),
        'visibility' => 'public',
        'category_id' => $category->id,
        'user_id' => $this->user->id
    ];

    // Act
    $response = $this->postJson(route('api.posts.store'), $data);

    // Assert
    $response->assertStatus(Response::HTTP_CREATED)
        ->assertJson(new \App\Http\Resources\PostResource(Post::first()));

    $this->assertDatabaseHas('posts', ['title' => 'New Post']);
})->skip('skip');

it('updates an existing post', function () {
    // Arrange


    $post = Post::factory()->create(['user_id' => $this->user->id]);

    $data = ['title' => 'Updated Post Title', 'body' => 'Updated body content'];

    // Act
    $response = $this->putJson(route('api.posts.update', ['post' => $post]), $data);

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'message' => 'Post actualizado con éxito',
            'post' => ['title' => 'Updated Post Title']
        ]);

    $this->assertDatabaseHas('posts', ['id' => $post->id, 'title' => 'Updated Post Title']);
})->skip('skip');

it('deletes a post', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $post = Post::factory()->create(['user_id' => $user->id]);

    // Act
    $response = $this->deleteJson(route('api.posts.destroy', ['post' => $post]));

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'message' => 'Post eliminado'
        ]);

    $this->assertDatabaseMissing('posts', ['id' => $post->id]);
})->skip('skip');

