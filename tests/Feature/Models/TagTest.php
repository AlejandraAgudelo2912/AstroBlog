<?php


use App\Models\Post;
use App\Models\Tag;

it('belongs to many posts', function () {
    //Arrange
    $tag = Tag::factory()->create();
    $post = Post::factory()->create();
    $post->tags()->attach($tag);

    //Act & Assert
    $tag->refresh();
    expect($tag->posts)
        ->toHaveCount(1)
        ->each->toBeInstanceOf(Post::class);
});
