<?php

use App\Models\ObservationPoint;

it('renders the index page with observation points', function () {
    // Arrange
    ObservationPoint::factory()->count(3)->create();

    // Act
    $response = $this->get(route('map.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('public.map.index');
    $response->assertViewHas('points');
});
