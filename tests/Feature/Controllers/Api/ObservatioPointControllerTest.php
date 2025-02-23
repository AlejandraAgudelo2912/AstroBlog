<?php

use App\Models\ObservationPoint;
use App\Models\User;
use Illuminate\Http\Response;

it('returns all observation points', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    ObservationPoint::factory()->count(3)->create();

    // Act
    $response = $this->getJson(route('api.map.index'));

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'description', 'latitude', 'longitude', 'user_id', 'created_at'],
            ],
        ]);
});

it('returns a specific observation point', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $point = ObservationPoint::factory()->create();

    // Act
    $response = $this->getJson(route('api.map.show', ['observationPoint' => $point->id]));

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'data' => [
                'id' => $point->id,
                'name' => $point->name,
                'description' => $point->description,
                'latitude' => $point->latitude,
                'longitude' => $point->longitude,
                'user_id' => $point->user_id,
            ],
        ]);
});

it('creates a new observation point', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $data = [
        'name' => 'New Observation Point',
        'description' => 'A beautiful place for stargazing',
        'latitude' => 40.7128,
        'longitude' => -74.0060,
    ];

    // Act
    $response = $this->postJson(route('api.map.store'), $data);

    // Assert
    $response->assertStatus(Response::HTTP_CREATED)
        ->assertJson([
            'success' => true,
            'message' => 'Punto de observación creado correctamente.',
            'observation_point' => [
                'name' => 'New Observation Point',
                'description' => 'A beautiful place for stargazing',
            ],
        ]);

    $this->assertDatabaseHas('observation_points', ['name' => 'New Observation Point']);
});

it('updates an observation point', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $point = ObservationPoint::factory()->create(['user_id' => $user->id]);

    $data = [
        'name' => 'Updated Observation Point',
        'description' => 'Now even better for stargazing',
        'latitude' => 41.1234,
        'longitude' => -73.9876,
    ];

    // Act
    $response = $this->putJson(route('api.map.update', ['observationPoint' => $point->id]), $data);

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'success' => true,
            'message' => 'Punto de observación actualizado correctamente.',
            'observation_point' => [
                'name' => 'Updated Observation Point',
                'description' => 'Now even better for stargazing',
            ],
        ]);

    $this->assertDatabaseHas('observation_points', ['name' => 'Updated Observation Point']);
});

it('deletes an observation point', function () {
    // Arrange
    $user = User::factory()->create();
    $this->actingAs($user, 'sanctum');

    $point = ObservationPoint::factory()->create(['user_id' => $user->id]);

    // Act
    $response = $this->deleteJson(route('api.map.destroy', ['observationPoint' => $point->id]));

    // Assert
    $response->assertStatus(Response::HTTP_OK)
        ->assertJson([
            'success' => true,
            'message' => 'Punto de observación eliminado correctamente.',
        ]);

    $this->assertDatabaseMissing('observation_points', ['id' => $point->id]);
});
