<?php

use App\Models\ObservationPoint;

it('shows the map page', function () {
    // Arrange
    // Act
    $this->get(route('map.index'))
        // Assert
        ->assertStatus(200)
        ->assertSee('Map');
});

it('shows all observation points', function () {
    // Arrange
    $observationPoints = ObservationPoint::factory()->count(3)->create();

    // Act
    $this->get(route('map.index'))
        // Assert
        ->assertStatus(200)
        ->assertSee($observationPoints[0]->name)
        ->assertSee($observationPoints[1]->name)
        ->assertSee($observationPoints[2]->name);

});
