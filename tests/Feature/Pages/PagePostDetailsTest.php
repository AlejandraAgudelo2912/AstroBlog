<?php

use App\Models\Post;

it('shows post details', function () {
    //Arrange
    $post = Post::factory()->create(['status'=>'published','visibility'=>'public']);

    //Act
    $response=$this->get('/posts/'.$post->slug);

    //Assert
    $response->assertStatus(200)
        ->assertSee($post->title)
        ->assertSee($post->body)
        ->assertSee($post->user->name);
});
