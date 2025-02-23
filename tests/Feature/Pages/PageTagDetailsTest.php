<?php

use App\Models\Tag;

it('shows details of a tag', function () {
    // Arrange
    $tag = Tag::factory()->create();

    // Act
    $this->get(route('tags.show', $tag))
        // Assert
        ->assertStatus(200)
        ->assertSee($tag->name);
});
