<?php

use App\Models\User;
use App\Models\ObservationPoint;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->user->assignRole('admin');
    $this->actingAs($this->user);
});

it('renders the map index page', function () {
    // Arrange
    ObservationPoint::factory()->count(3)->create();

    // Act
    $response = $this->get(route('admin.map.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.map.index');
    $response->assertViewHas('points');
});

it('stores a new observation point successfully', function () {
    // Arrange
    $data = [
        'user_id' => $this->user->id,
        'name' => 'New Observation Point',
        'description' => 'A beautiful location for stargazing.',
        'latitude' => 45.12345,
        'longitude' => -75.98765,
    ];

    // Act
    $this->post(route('admin.map.store'), $data);

    // Assert
    $this->assertDatabaseHas('observation_points', ['name' => 'New Observation Point']);
});
