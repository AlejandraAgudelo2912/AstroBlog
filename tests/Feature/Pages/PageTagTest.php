<?php


use App\Models\Tag;

it('shows a list of all tags', function () {
    //Arrange
    $tag = Tag::factory(3)->create();
    $response = $this->get('/tags');

    //Act & Assert
    $response->assertSee($tag[0]->name)
        ->assertSee($tag[1]->name)
        ->assertSee($tag[2]->name);
});
