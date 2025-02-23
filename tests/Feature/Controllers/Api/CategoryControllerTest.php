<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Response;

it('returns a list of categories', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    Category::factory()->count(3)->create();

    // Act
    $response = $this->getJson(route('api.categories.index'));

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'slug', 'description', 'created_at', 'updated_at'],
            ],
        ]);
});

it('returns a specific category', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $category = Category::factory()->create();

    // Act
    $response = $this->getJson(route('api.categories.show', $category));

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'data' => [
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description,
            ],
        ]);
});

it('creates a new category', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $data = [
        'name' => 'New Category',
        'description' => 'A test category',
    ];

    // Act
    $response = $this->postJson(route('api.categories.store'), $data);

    // Assert
    $response->assertStatus(Response::HTTP_CREATED)
        ->assertJson([
            'success' => true,
            'message' => 'Categoría creada correctamente.',
            'category' => [
                'name' => 'New Category',
                'description' => 'A test category',
            ],
        ]);

    $this->assertDatabaseHas('categories', ['name' => 'New Category']);
});

it('updates an existing category', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $category = Category::factory()->create();
    $data = ['name' => 'Updated Category Name'];

    // Act
    $response = $this->putJson(route('api.categories.update', $category), $data);

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'success' => true,
            'message' => 'Categoría actualizada correctamente.',
            'category' => ['name' => 'Updated Category Name'],
        ]);

    $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Updated Category Name']);
});

it('deletes a category', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $category = Category::factory()->create();

    // Act
    $response = $this->deleteJson(route('api.categories.destroy', $category));

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'success' => true,
            'message' => 'Categoría eliminada correctamente.',
        ]);

    $this->assertDatabaseMissing('categories', ['id' => $category->id]);
});
