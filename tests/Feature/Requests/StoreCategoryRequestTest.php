<?php

use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\Validator;

beforeEach(function (){
    app()->setLocale('en');
});

it('passes validation with valid data', function () {
    $data = [
        'name' => 'New Category',
        'description' => 'This is a test category'
    ];

    $request = new StoreCategoryRequest();
    $validator = Validator::make($data, $request->rules());

    expect($validator->passes())->toBeTrue();
});

it('fails validation when name is missing', function () {
    $data = [
        'description' => 'This is a test category'
    ];

    $request = new StoreCategoryRequest();
    $validator = Validator::make($data, $request->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('name'))->toBe('The name field is required.');
});

it('fails validation when name exceeds max length', function () {
    $data = [
        'name' => str_repeat('A', 256), // Más de 255 caracteres
        'description' => 'This is a test category'
    ];

    $request = new StoreCategoryRequest();
    $validator = Validator::make($data, $request->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('name'))->toBe('The name field must not be greater than 255 characters.');
});

it('fails validation when name is not unique', function () {
    \App\Models\Category::factory()->create(['name' => 'Duplicate Name']);

    $data = [
        'name' => 'Duplicate Name',
        'description' => 'This is a duplicate category'
    ];

    $request = new StoreCategoryRequest();
    $validator = Validator::make($data, $request->rules());

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('name'))->toBe('The name has already been taken.');
});

