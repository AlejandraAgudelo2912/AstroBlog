<?php

use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user, 'sanctum');
});

it('returns all tags', function () {
    // Arrange
    Tag::factory()->count(3)->create();

    // Act
    $response = $this->getJson(route('api.tags.index'));

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'slug', 'created_at']
            ]
        ]);
});

it('returns a specific tag', function () {
    // Arrange
    $tag = Tag::factory()->create();

    // Act
    $response = $this->getJson(route('api.tags.show', ['tag' => $tag->id]));

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'data' => [
                'id' => $tag->id,
                'name' => $tag->name,
                'slug' => $tag->slug,
            ]
        ]);
});

it('creates a new tag', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $data = [
        'name' => 'Astronomy',
    ];

    // Act
    $response = $this->postJson(route('api.tags.store'), $data);

    // Assert
    $response->assertStatus(Response::HTTP_CREATED)
        ->assertJson([
            'success' => true,
            'message' => 'Tag creado correctamente.',
            'tag' => [
                'name' => 'Astronomy'
            ]
        ]);

    $this->assertDatabaseHas('tags', ['name' => 'Astronomy']);
});

it('updates an existing tag', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $tag = Tag::factory()->create();

    $data = [
        'name' => 'Updated Tag Name',
    ];

    // Act
    $response = $this->putJson(route('api.tags.update', ['tag' => $tag->id]), $data);

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'success' => true,
            'message' => 'Tag actualizado correctamente.',
            'tag' => [
                'name' => 'Updated Tag Name'
            ]
        ]);

    $this->assertDatabaseHas('tags', ['id' => $tag->id, 'name' => 'Updated Tag Name']);
});

it('deletes a tag', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $tag = Tag::factory()->create();

    // Act
    $response = $this->deleteJson(route('api.tags.destroy', ['tag' => $tag->id]));

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'success' => true,
            'message' => 'Tag eliminado correctamente.'
        ]);

    $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
});
