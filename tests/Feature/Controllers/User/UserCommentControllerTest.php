<?php

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->user->assignRole('user');
    $this->actingAs($this->user);
});

it('renders the index page showing user comments on a post', function () {
    // Arrange
    $post = Post::factory()->create();
    Comment::factory()->count(3)->create([
        'post_id' => $post->id,
        'user_id' => $this->user->id
    ]);

    // Act
    $response = $this->get(route('user.posts.comments.index', $post));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.posts.show');
    $response->assertViewHas(['comments', 'post']);
});

it('renders the show page for a comment', function () {
    // Arrange
    $post = Post::factory()->create();
    $comment = Comment::factory()->create(['user_id' => $this->user->id, 'post_id' => $post->id]);

    // Act
    $response = $this->get(route('user.posts.comments.show', ['post' => $post,'comment' => $comment]));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.comments.show');
    $response->assertViewHas('comment', $comment);
});

it('renders the create page for adding a comment', function () {
    // Arrange
    $post = Post::factory()->create();

    // Act
    $response = $this->get(route('user.posts.comments.create', $post));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.comments.create');
    $response->assertViewHas('post', $post);
});

it('stores a new comment successfully', function () {
    // Arrange
    $post = Post::factory()->create();

    $data = [
        'title' => 'New Comment Title',
        'body' => 'This is the content of the comment.',
    ];

    // Act
    $response = $this->post(route('user.posts.comments.store', $post), $data);

    // Assert
    $response->assertRedirect(route('user.posts.comments.index', $post));
    $this->assertDatabaseHas('comments', ['title' => 'New Comment Title']);
});

it('renders the edit page for a comment', function () {
    // Arrange
    $post = Post::factory()->create();
    $comment = Comment::factory()->create(['user_id' => $this->user->id, 'post_id' => $post->id]);

    // Act
    $response = $this->get(route('user.posts.comments.edit', [ 'post' => $post,'comment' => $comment]));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.comments.edit');
    $response->assertViewHas('comment', $comment);
});

it('updates a comment successfully', function () {
    // Arrange
    $post = Post::factory()->create();
    $comment = Comment::factory()->create(['user_id' => $this->user->id, 'post_id' => $post->id]);

    $newData = [
        'title' => 'Updated comment title',
        'body' => 'Updated comment content',
    ];

    // Act
    $response = $this->put(route('user.posts.comments.update', [ 'post' => $post,'comment' => $comment]), $newData);

    // Assert
    $response->assertRedirect(route('user.posts.comments.index',['post' => $post]));
    $this->assertDatabaseHas('comments', ['body' => 'Updated comment content']);
});

it('deletes a comment successfully', function () {
    // Arrange
    $post = Post::factory()->create();
    $comment = Comment::factory()->create(['user_id' => $this->user->id, 'post_id' => $post->id]);

    // Act
    $response = $this->delete(route('user.posts.comments.destroy',['post' => $post,'comment' => $comment]));

    // Assert
    $response->assertRedirect(route('user.posts.comments.index',['post' => $post]));
    $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
})->skip('skip');

it('renders the reply page for a comment', function () {
    // Arrange
    $post = Post::factory()->create();
    $comment = Comment::factory()->create(['post_id' => $post->id]);

    // Act
    $response = $this->get(route('user.posts.comments.replied', ['post' => $post, 'comment' => $comment]));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.comments.reply');
    $response->assertViewHas(['post', 'comment']);
});

it('stores a reply to a comment successfully', function () {
    // Arrange
    $post = Post::factory()->create();
    $comment = Comment::factory()->create(['post_id' => $post->id]);

    $data = [
        'title' => 'Reply Title',
        'body' => 'This is a reply to the comment.',
    ];

    // Act
    $response = $this->post(route('user.posts.comments.reply', ['post' => $post, 'comment' => $comment]), $data);

    // Assert
    $response->assertRedirect(route('posts.show', $post));
    $this->assertDatabaseHas('comments', ['title' => 'Reply Title', 'parent_id' => $comment->id]);
});
