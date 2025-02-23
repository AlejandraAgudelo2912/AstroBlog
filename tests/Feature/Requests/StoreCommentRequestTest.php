<?php

use App\Http\Requests\StoreCommentRequest;

beforeEach(function () {
    app()->setLocale('en');
});

it('passes validation with valid data', function () {
    // Arrange
    $data = [
        'title' => 'This is a comment title',
        'body' => 'This is the body of the comment.',
        'parent_id' => null,
    ];

    $request = new StoreCommentRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->passes())->toBeTrue();
});

it('fails validation when title is missing', function () {
    // Arrange
    $data = [
        'body' => 'This is the body of the comment.',
        'parent_id' => null,
    ];

    $request = new StoreCommentRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('title'))->toBe('The title field is required.');
});

it('fails validation when body is missing', function () {
    // Arrange
    $data = [
        'title' => 'This is a comment title',
        'parent_id' => null,
    ];

    $request = new StoreCommentRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('body'))->toBe('The body field is required.');
});

it('fails validation when parent_id is invalid', function () {
    // Arrange
    $data = [
        'title' => 'Valid Title',
        'body' => 'Valid body',
        'parent_id' => 9999, // 🔹 ID que no existe en la tabla comments
    ];

    $request = new StoreCommentRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('parent_id'))->toBe('The selected parent id is invalid.');
});
