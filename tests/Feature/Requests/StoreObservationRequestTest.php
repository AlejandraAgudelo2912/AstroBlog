<?php
use App\Http\Requests\StoreObservationPointRequest;
use Illuminate\Support\Facades\Validator;

beforeEach(function () {
    app()->setLocale('en');
});

it('passes validation with valid data', function () {
    // Arrange
    $data = [
        'name' => 'Observation Point',
        'description' => 'A great place for stargazing.',
        'latitude' => 45.12345,
        'longitude' => -75.98765,
    ];

    $request = new StoreObservationPointRequest();

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->passes())->toBeTrue();
});

it('fails validation when name is missing', function () {
    // Arrange
    $data = [
        'description' => 'A great place for stargazing.',
        'latitude' => 45.12345,
        'longitude' => -75.98765,
    ];

    $request = new StoreObservationPointRequest();

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('name'))->toBe('The name field is required.');
});

it('fails validation when latitude is missing', function () {
    // Arrange
    $data = [
        'name' => 'Observation Point',
        'description' => 'A great place for stargazing.',
        'longitude' => -75.98765,
    ];

    $request = new StoreObservationPointRequest();

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('latitude'))->toBe('The latitude field is required.');
});

it('fails validation when longitude is missing', function () {
    // Arrange
    $data = [
        'name' => 'Observation Point',
        'description' => 'A great place for stargazing.',
        'latitude' => 45.12345,
    ];

    $request = new StoreObservationPointRequest();

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('longitude'))->toBe('The longitude field is required.');
});

it('fails validation when latitude is not a number', function () {
    // Arrange
    $data = [
        'name' => 'Observation Point',
        'description' => 'A great place for stargazing.',
        'latitude' => 'not-a-number',
        'longitude' => -75.98765,
    ];

    $request = new StoreObservationPointRequest();

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('latitude'))->toBe('The latitude field must be a number.');
});

it('fails validation when longitude is not a number', function () {
    // Arrange
    $data = [
        'name' => 'Observation Point',
        'description' => 'A great place for stargazing.',
        'latitude' => 45.12345,
        'longitude' => 'not-a-number',
    ];

    $request = new StoreObservationPointRequest();

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('longitude'))->toBe('The longitude field must be a number.');
});

