<?php

use App\Models\Post;

it('shows post details', function () {
    //Arrange
    $post = Post::factory()->create();

    //Act
    $response=$this->get('/posts/'.$post->slug);

    //Assert
    $response->assertStatus(200)
        ->assertSee($post->title)
        ->assertSee($post->body);

});
