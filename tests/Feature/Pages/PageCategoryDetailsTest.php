<?php

use App\Models\Category;

it('shows category details', function () {
    // Arrange
    $category = Category::factory()->create();
    $response = $this->get('/categories/'.$category->id);

    // Act & Assert
    $response->assertStatus(200)
        ->assertSee($category->name)
        ->assertSee($category->description);
});
