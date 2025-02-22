<?php

it('renders the index page with events', function () {
    // Arrange
    Http::fake([
        'eonet.gsfc.nasa.gov/api/v2.1/events' => Http::response([
            'events' => [
                ['id' => 'EONET_1', 'title' => 'Event 1'],
                ['id' => 'EONET_2', 'title' => 'Event 2'],
            ],
        ], 200),
    ]);

    // Act
    $response = $this->get(route('eonet.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('eonet.index');
    $response->assertViewHas('events');
});
