<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\UploadedFile;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->user->assignRole('user');
    $this->actingAs($this->user);
});

it('renders the index page with published posts', function () {
    // Arrange
    Post::factory()->count(3)->create(['status' => 'published']);

    // Act
    $response = $this->get(route('user.posts.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.posts.index');
    $response->assertViewHas('posts');
});

it('renders the create page', function () {
    // Act
    $response = $this->get(route('user.posts.create'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.posts.create');
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
    $response = $this->post(route('user.posts.store'), $data);

    // Assert
    $response->assertRedirect(route('user.posts.index'));
    $this->assertDatabaseHas('posts', ['title' => 'New Post Title']);
});

it('renders the show page for a post', function () {
    // Arrange
    $post = Post::factory()->create(['status' => 'published', 'visibility' => 'public']);

    // Act
    $response = $this->get(route('user.posts.show', $post));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.posts.show');
    $response->assertViewHas('post', $post);
});

it('renders the edit page for a post', function () {
    // Arrange
    $post = Post::factory()->create(['user_id' => $this->user->id]);

    // Act
    $response = $this->get(route('user.posts.edit', $post));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.posts.edit');
    $response->assertViewHas(['post', 'categories', 'tags']);
});

it('updates a post successfully', function () {
    // Arrange
    $post = Post::factory()->create(['user_id' => $this->user->id]);
    $newData = [
        'title' => 'Updated Post Title',
        'body' => 'Updated body content.',
        'category_id' => $post->category_id,
        'status' => 'draft',
        'published_at' => now()->toDateTimeString(),
        'visibility' => 'private',
    ];

    // Act
    $response = $this->put(route('user.posts.update', $post), $newData);

    // Assert
    $response->assertRedirect(route('user.posts.index'));
    $this->assertDatabaseHas('posts', ['title' => 'Updated Post Title']);
});

it('soft deletes a post', function () {

    // Arrange
    $post = Post::factory()->create(['user_id' => $this->user->id]);

    // Act
    $response = $this->delete(route('user.posts.destroy', $post));

    // Assert
    $response->assertRedirect(route('user.posts.index'));
    $this->assertSoftDeleted('posts', ['id' => $post->id]);

});

it('renders my posts page', function () {
    // Arrange
    Post::factory()->count(3)->create(['user_id' => $this->user->id]);

    // Act
    $response = $this->get(route('user.posts.my'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.posts.index');
    $response->assertViewHas('posts');
});
