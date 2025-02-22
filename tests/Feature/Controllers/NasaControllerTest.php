<?php

it('renders the picture of the day page', function () {
    // Arrange
    Http::fake([
        'api.nasa.gov/planetary/apod' => Http::response([
            'title' => 'Astronomy Picture of the Day',
            'url' => 'https://apod.nasa.gov/apod/image.jpg',
            'explanation' => 'This is a test explanation.',
        ], 200),
    ]);

    // Act
    $response = $this->get(route('nasa.picture'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('nasa.picture');
    $response->assertViewHas('data');
});

it('renders the asteroid data page', function () {
    // Arrange
    Http::fake([
        'api.nasa.gov/neo/rest/v1/feed' => Http::response([
            'near_earth_objects' => [
                ['id' => '1', 'name' => 'Asteroid 1', 'hazardous' => false],
                ['id' => '2', 'name' => 'Asteroid 2', 'hazardous' => true],
            ],
        ], 200),
    ]);

    // Act
    $response = $this->get(route('nasa.asteroids'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('nasa.asteroids');
    $response->assertViewHas('data');
});
