<?php

use App\Http\Requests\StoreTagRequest;
use Illuminate\Support\Facades\Validator;

beforeEach(function () {
    app()->setLocale('en');
});

it('passes validation with valid data', function () {
    // Arrange
    $data = [
        'name' => 'Valid Tag Name',
    ];

    $request = new StoreTagRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->passes())->toBeTrue();
});

it('fails validation when name is missing', function () {
    // Arrange
    $data = [];

    $request = new StoreTagRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('name'))->toBe('The name field is required.');
});

it('fails validation when name exceeds max length', function () {
    // Arrange
    $data = [
        'name' => str_repeat('A', 256),
    ];

    $request = new StoreTagRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('name'))->toBe('The name field must not be greater than 255 characters.');
});

it('fails validation when name is not a string', function () {
    // Arrange
    $data = [
        'name' => 12345,
    ];

    $request = new StoreTagRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('name'))->toBe('The name field must be a string.');
});
