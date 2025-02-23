<?php

use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Support\Facades\Validator;

beforeEach(function () {
    app()->setLocale('en');
});

it('passes validation with valid data', function () {
    // Arrange
    $data = [
        'title' => 'Updated Comment Title',
        'body' => 'This is an updated comment body.',
    ];

    $request = new UpdateCommentRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->passes())->toBeTrue();
});

it('fails validation when title is missing', function () {
    // Arrange
    $data = [
        'body' => 'This is an updated comment body.',
    ];

    $request = new UpdateCommentRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('title'))->toBe('The title field is required.');
});

it('fails validation when body is missing', function () {
    // Arrange
    $data = [
        'title' => 'Updated Comment Title',
    ];

    $request = new UpdateCommentRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('body'))->toBe('The body field is required.');
});
