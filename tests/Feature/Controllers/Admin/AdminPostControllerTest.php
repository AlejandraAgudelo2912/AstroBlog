<?php

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\UploadedFile;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->user->assignRole('admin');
    $this->actingAs($this->user);
});

it('renders the index page', function () {
    // Arrange
    Post::factory()->count(3)->create();

    // Act
    $response = $this->get(route('admin.posts.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.posts.index');
    $response->assertViewHas('posts');
});

it('renders the create page', function () {
    // Act
    $response = $this->get(route('admin.posts.create'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.posts.create');
    $response->assertViewHas(['categories', 'tags']);
});

it('stores a new post successfully', function () {
    // Arrange
    $category = Category::factory()->create();
    $tags = Tag::factory()->count(2)->create();

    $data = [
        'title' => 'New Post Title',
        'body' => 'This is the body of the post.',
        'category_id' => $category->id,
        'status' => 'published',
        'published_at' => now()->toDateTimeString(),
        'visibility' => 'public',
        'tags' => $tags->pluck('id')->toArray(),
        'cover_image' => UploadedFile::fake()->image('cover.jpg'),
    ];

    // Act
    $response = $this->post(route('admin.posts.store'), $data);

    // Assert
    $response->assertRedirect(route('admin.posts.index'));
    $this->assertDatabaseHas('posts', ['title' => 'New Post Title']);
});

it('renders the show page for a post', function () {
    // Arrange
    $post = Post::factory()->create();

    // Act
    $response = $this->get(route('admin.posts.show', $post));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.posts.show');
    $response->assertViewHas('post', $post);
});

it('renders the edit page for a post', function () {
    // Arrange
    $post = Post::factory()->create();

    // Act
    $response = $this->get(route('admin.posts.edit', $post));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.posts.edit');
    $response->assertViewHas(['post', 'categories', 'tags']);
});

it('updates a post successfully', function () {
    // Arrange
    $post = Post::factory()->create();
    $newData = [
        'title' => 'Updated Post Title',
        'body' => 'Updated body content.',
        'category_id' => $post->category_id,
        'status' => 'draft',
        'published_at' => now()->toDateTimeString(),
        'visibility' => 'private',
    ];

    // Act
    $response = $this->put(route('admin.posts.update', $post), $newData);

    // Assert
    $response->assertRedirect(route('admin.posts.index'));
    $this->assertDatabaseHas('posts', ['title' => 'Updated Post Title']);
});

it('soft deletes a post', function () {

    // Arrange
    $post = Post::factory()->create();

    // Act
    $response = $this->delete(route('admin.posts.destroy', $post));

    // Assert
    $response->assertRedirect(route('admin.posts.index'));
    $this->assertSoftDeleted('posts', ['id' => $post->id]);
});
