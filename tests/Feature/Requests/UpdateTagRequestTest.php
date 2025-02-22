<?php

use App\Http\Requests\UpdateTagRequest;
use Illuminate\Support\Facades\Validator;

beforeEach(function () {
    app()->setLocale('en');
});

it('passes validation with valid data', function () {
    // Arrange
    $data = [
        'name' => 'Updated Tag Name',
    ];

    $request = new UpdateTagRequest();

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->passes())->toBeTrue();
});

it('fails validation when name is missing', function () {
    // Arrange
    $data = [];

    $request = new UpdateTagRequest();

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('name'))->toBe('The name field is required.');
});

it('fails validation when name is not a string', function () {
    // Arrange
    $data = [
        'name' => 12345,
    ];

    $request = new UpdateTagRequest();

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('name'))->toBe('The name field must be a string.');
});
