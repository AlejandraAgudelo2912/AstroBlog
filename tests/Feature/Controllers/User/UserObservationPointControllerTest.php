<?php

use App\Models\User;
use App\Models\ObservationPoint;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->user->assignRole('user');
    $this->actingAs($this->user);
});

it('renders the index page', function () {
    // Arrange
    ObservationPoint::factory()->count(3)->create();

    // Act
    $response = $this->get(route('user.map.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('user.map.index');
    $response->assertViewHas('points');
});
