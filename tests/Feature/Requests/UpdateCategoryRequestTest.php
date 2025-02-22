<?php

use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Validator;

beforeEach(function () {
    app()->setLocale('en');
});

it('passes validation with a valid name', function () {
    // Arrange
    $category = \App\Models\Category::factory()->create();

    $data = [
        'name' => 'Updated Category Name',
    ];

    $request = new UpdateCategoryRequest();

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->passes())->toBeTrue();
});

it('fails validation when name is missing', function () {
    // Arrange
    $data = [];

    $request = new UpdateCategoryRequest();

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('name'))->toBe('The name field is required.');
});

it('fails validation when name is not unique', function () {
    // Arrange
    $existingCategory = \App\Models\Category::factory()->create(['name' => 'Existing Category']);

    $data = [
        'name' => 'Existing Category',
    ];

    $request = new UpdateCategoryRequest();

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('name'))->toBe('The name has already been taken.');
});
