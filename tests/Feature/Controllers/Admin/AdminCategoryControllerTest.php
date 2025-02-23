<?php

use App\Models\Category;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->user->assignRole('admin');
    $this->actingAs($this->user);
});

it('renders the index page', function () {
    // Arrange
    Category::factory()->count(3)->create();

    // Act
    $response = $this->get(route('admin.categories.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.categories.index');
    $response->assertViewHas('categories');
});

it('renders the create page', function () {
    // Act
    $response = $this->get(route('admin.categories.create'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.categories.create');
});

it('stores a new category successfully', function () {
    // Arrange
    $data = [
        'name' => 'New Category',
        'slug' => 'new-category',
    ];

    // Act
    $response = $this->post(route('admin.categories.store'), $data);

    // Assert
    $response->assertRedirect(route('admin.categories.index'));
    $this->assertDatabaseHas('categories', ['name' => 'New Category']);
});

it('renders the show page for a category', function () {
    // Arrange
    $category = Category::factory()->create();

    // Act
    $response = $this->get(route('admin.categories.show', $category));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.categories.show');
    $response->assertViewHas('category', $category);
});

it('renders the edit page for a category', function () {
    // Arrange
    $category = Category::factory()->create();

    // Act
    $response = $this->get(route('admin.categories.edit', $category));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.categories.edit');
    $response->assertViewHas('category', $category);
});

it('updates a category successfully', function () {
    // Arrange
    $category = Category::factory()->create();
    $newData = [
        'name' => 'Updated Category Name',
    ];

    // Act
    $response = $this->put(route('admin.categories.update', $category), $newData);

    // Assert
    $response->assertRedirect(route('admin.categories.index'));
    $this->assertDatabaseHas('categories', ['name' => 'Updated Category Name']);
});

it('deletes a category successfully', function () {
    // Arrange
    $category = Category::factory()->create();

    // Act
    $response = $this->delete(route('admin.categories.destroy', $category));

    // Assert
    $response->assertRedirect(route('admin.categories.index'));
    $this->assertDatabaseMissing('categories', ['id' => $category->id]);
});
