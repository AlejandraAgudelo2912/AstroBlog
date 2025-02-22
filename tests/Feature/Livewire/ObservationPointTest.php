<?php


use App\Livewire\ObservationPointForm;
use App\Models\User;

it('renders the component successfully', function () {
    //Arrange

    //Act & Assert
    Livewire::test(ObservationPointForm::class)
        ->assertStatus(200);
});

it('shows the observation form when showObservationForm is called', function () {
    //Arrange

    //Act & Assert
    Livewire::test(ObservationPointForm::class)
        ->call('showObservationForm')
        ->assertSet('showForm', true);
});

it('hides the observation form when hideObservationForm is called', function () {
    //Arrange

    //Act & Assert
    Livewire::test(ObservationPointForm::class)
        ->call('hideObservationForm')
        ->assertSet('showForm', false);
});

it('sets coordinates and shows form when setCoordinates is triggered', function () {
    //Arrange
    $latitude = 12.345;
    $longitude = -98.765;

    //Act & Assert
    Livewire::test(ObservationPointForm::class)
        ->dispatch('setCoordinates', $latitude, $longitude)
        ->assertSet('latitude', $latitude)
        ->assertSet('longitude', $longitude)
        ->assertSet('showForm', true);

});

it('validates required fields before saving', function () {
    //Arrange

    //Act & Assert
    Livewire::test(ObservationPointForm::class)
        ->call('save')
        ->assertHasErrors(['name', 'latitude', 'longitude']);
});

it('saves a new observation point successfully', function () {
    //Arrange
    $user = User::factory()->create();
    $this->actingAs($user);

    //Act & Assert
    Livewire::test(ObservationPointForm::class)
        ->set('name', 'Punto de Observación')
        ->set('description', 'Descripción del punto de observación.')
        ->set('latitude', 10.12345)
        ->set('longitude', -75.98765)
        ->call('save')
        ->assertSet('showForm', false)
        ->assertSet('name', null)
        ->assertSet('description', null)
        ->assertSet('latitude', null)
        ->assertSet('longitude', null);

    expect(\App\Models\ObservationPoint::count())->toBe(1);
});
