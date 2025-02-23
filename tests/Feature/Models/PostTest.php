<?php

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

it('belongs to an user', function () {
    // Arrange
    $user = User::factory()->has(Post::factory())->create();
    $post = Post::factory()->create(['user_id' => $user->id]);

    // Act
    $postUser = $post->user;

    // Assert
    $this->assertInstanceOf(User::class, $postUser);
    $this->assertEquals($user->id, $postUser->id);
});

it('has comments', function () {
    // Arrange
    $post = Post::factory()->create();
    $post->comments()->save(Comment::factory()->make(['user_id' => User::factory()->create()->id]));

    // Act & Assert
    $post->refresh();
    expect($post->comments)
        ->toHaveCount(1)
        ->each->toBeInstanceOf(Comment::class);

});

it('belongs to a category', function () {
    // Arrange
    $category = Category::factory()->create();
    $post = Post::factory()->create(['category_id' => $category->id]);

    // Act & Assert
    $post->refresh();
    expect($post->category)
        ->toBeInstanceOf(Category::class)
        ->and($post->category->id)
        ->toBe($category->id);
});

it('belongs to many tags', function () {
    // Arrange
    $post = Post::factory()->create();
    $post->tags()->attach(Tag::factory()->create());

    // Act & Assert
    $post->refresh();
    expect($post->tags)
        ->toHaveCount(1)
        ->each->toBeInstanceOf(Tag::class);

});

it('returns only published and public posts', function () {
    // Arrange
    $post = Post::factory()->create(['status' => 'published', 'visibility' => 'public']);
    $post2 = Post::factory()->create(['status' => 'draft', 'visibility' => 'public']);

    // Act & Assert
    $posts = Post::publicados()->get();
    expect($posts)
        ->toHaveCount(1)
        ->first()
        ->toBeInstanceOf(Post::class)
        ->and($posts->first()->id)
        ->toBe($post->id);

});

it('returns the top 3 liked posts', function () {
    // Arrange
    $post = Post::factory()->create(['status' => 'published', 'visibility' => 'public']);
    $post2 = Post::factory()->create(['status' => 'published', 'visibility' => 'public']);
    $post3 = Post::factory()->create(['status' => 'published', 'visibility' => 'public']);

    // Act & Assert
    $posts = Post::topLiked()->get();
    expect($posts)
        ->toHaveCount(3)
        ->each->toBeInstanceOf(Post::class);
});
