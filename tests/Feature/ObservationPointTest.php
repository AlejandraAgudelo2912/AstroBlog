<?php


use App\Models\ObservationPoint;
use App\Models\User;

it('belongs to an user', function () {
    //Arrange
    $user = User::factory()->has(ObservationPoint::factory())->create();
    $observationPoint=ObservationPoint::factory()->create(['user_id'=>$user->id]);

    //Act & Assert
    $observationPoint->refresh();
    expect($observationPoint->user)
        ->toBeInstanceOf(User::class);

});
