<?php

use App\Models\Category;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->user->assignRole('user');
    $this->actingAs($this->user);
});

it('renders the index page', function () {
    // Arrange
    Category::factory()->count(3)->create();

    // Act
    $response = $this->get(route('user.categories.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.categories.index');
    $response->assertViewHas('categories');
});

it('renders the show page for a category', function () {
    // Arrange
    $category = Category::factory()->create();

    // Act
    $response = $this->get(route('user.categories.show', $category));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.categories.show');
    $response->assertViewHas('category', $category);
});
