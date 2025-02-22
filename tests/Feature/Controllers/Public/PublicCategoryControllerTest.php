<?php

use App\Models\Category;

it('renders the index page with categories', function () {
    // Arrange
    Category::factory()->count(3)->create();

    // Act
    $response = $this->get(route('categories.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('public.categories.index');
    $response->assertViewHas('categories');
});

it('renders the show page for a category', function () {
    // Arrange
    $category = Category::factory()->create();

    // Act
    $response = $this->get(route('categories.show', $category));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('public.categories.show');
    $response->assertViewHas('category', $category);
});
