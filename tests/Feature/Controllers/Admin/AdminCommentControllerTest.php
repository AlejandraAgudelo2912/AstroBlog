<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->user->assignRole('admin');
    $this->actingAs($this->user);
});

it('renders the index page', function () {
    // Arrange
    $post = Post::factory()->create();
    Comment::factory()->count(3)->create(['post_id' => $post->id]);

    // Act
    $response = $this->get(route('admin.posts.comments.index', ['post' => $post]));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.comments.index');
    $response->assertViewHas('comments');
});

it('renders the create page for a comment', function () {
    // Arrange
    $post = Post::factory()->create();
    Comment::factory()->create(['post_id' => $post->id]);

    // Act
    $response = $this->get(route('admin.posts.comments.create', ['post' => $post]));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.comments.create');
    $response->assertViewHas(['post', 'parent_id']);
});

it('stores a new comment successfully', function () {
    // Arrange
    $post = Post::factory()->create();
    $data = [
        'title' => 'New Comment Title',
        'body' => 'This is a comment body.',
        'parent_id' => null,
    ];

    // Act
    $response = $this->post(route('admin.posts.comments.store', $post), $data);

    // Assert
    $response->assertRedirect(route('posts.show', $post));
    $this->assertDatabaseHas('comments', ['title' => 'New Comment Title']);
});

it('renders the show page for a comment', function () {
    // Arrange
    $post = Post::factory()->create();
    $comment = Comment::factory()->create([
        'post_id' => $post->id,
    ]);

    // Act
    $response = $this->get(route('admin.posts.comments.show', ['post' => $post, 'comment' => $comment]));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.comments.show');
    $response->assertViewHas('comment', $comment);
});

it('renders the edit page for a comment', function () {
    // Arrange
    $post = Post::factory()->create();
    $comment = Comment::factory()->create([
        'post_id' => $post->id,
        'slug' => 'test-comment-slug']);

    // Act
    $response = $this->get(route('admin.posts.comments.edit', ['post' => $post, 'comment' => $comment]));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.comments.edit');
    $response->assertViewHas('comment', $comment);
});

it('updates a comment successfully', function () {
    // Arrange
    $post = Post::factory()->create();
    $comment = Comment::factory()->create(['post_id' => $post->id]);
    $newData = [
        'title' => 'Updated comment title.',
        'body' => 'Updated comment body.',
    ];

    // Act
    $response = $this->put(route('admin.posts.comments.update', ['post' => $post, 'comment' => $comment]), $newData);

    // Assert
    $response->assertRedirect(route('admin.posts.comments.index', ['post' => $post]));
    $this->assertDatabaseHas('comments', ['body' => 'Updated comment body.']);
});

it('deletes a comment successfully', function () {
    // Arrange
    $post = Post::factory()->create();
    $comment = Comment::factory()->create([
        'post_id' => $post->id]);

    // Act
    $response = $this->delete(route('admin.posts.comments.destroy', ['post' => $post->slug, 'comment' => $comment->slug]));

    // Assert
    $response->assertRedirect(route('admin.posts.comments.index', ['post' => $post]));
    $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
})->skip('skip');
