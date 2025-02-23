<?php

use App\Http\Requests\UpdatePostRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

beforeEach(function () {
    app()->setLocale('en');
});

it('passes validation with valid data', function () {
    // Arrange
    $category = \App\Models\Category::factory()->create();
    $tags = \App\Models\Tag::factory()->count(2)->create();

    $data = [
        'title' => 'Updated Post Title',
        'body' => 'This is an updated post body.',
        'published_at' => now()->toDateTimeString(),
        'status' => 'published',
        'visibility' => 'public',
        'category_id' => $category->id,
        'tags' => $tags->pluck('id')->toArray(),
        'cover_image' => UploadedFile::fake()->image('cover.jpg', 500, 500),
    ];

    $request = new UpdatePostRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->passes())->toBeTrue();
});

it('fails validation when title is missing', function () {
    // Arrange
    $data = [
        'body' => 'This is an updated post body.',
        'published_at' => now()->toDateTimeString(),
        'status' => 'published',
        'visibility' => 'public',
        'category_id' => 1,
    ];

    $request = new UpdatePostRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('title'))->toBe('The title field is required.');
});

it('fails validation when body is missing', function () {
    // Arrange
    $data = [
        'title' => 'Updated Post Title',
        'published_at' => now()->toDateTimeString(),
        'status' => 'published',
        'visibility' => 'public',
        'category_id' => 1,
    ];

    $request = new UpdatePostRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('body'))->toBe('The body field is required.');
});

it('fails validation when category_id is missing', function () {
    // Arrange
    $data = [
        'title' => 'Updated Post Title',
        'body' => 'This is an updated post body.',
        'published_at' => now()->toDateTimeString(),
        'status' => 'published',
        'visibility' => 'public',
    ];

    $request = new UpdatePostRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('category_id'))->toBe('The category id field is required.');
});

it('fails validation when category_id does not exist', function () {
    // Arrange
    $data = [
        'title' => 'Updated Post Title',
        'body' => 'This is an updated post body.',
        'published_at' => now()->toDateTimeString(),
        'status' => 'published',
        'visibility' => 'public',
        'category_id' => 9999, // 🔹 ID que no existe
    ];

    $request = new UpdatePostRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('category_id'))->toBe('The selected category id is invalid.');
});

it('fails validation when cover_image is not an image', function () {
    // Arrange
    $data = [
        'title' => 'Updated Post Title',
        'body' => 'This is an updated post body.',
        'published_at' => now()->toDateTimeString(),
        'status' => 'published',
        'visibility' => 'public',
        'category_id' => 1,
        'cover_image' => UploadedFile::fake()->create('document.pdf', 500, 'application/pdf'),
    ];

    $request = new UpdatePostRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('cover_image'))->toBe('The cover image field must be an image.');
});

it('fails validation when cover_image exceeds max size', function () {
    // Arrange
    $data = [
        'title' => 'Updated Post Title',
        'body' => 'This is an updated post body.',
        'published_at' => now()->toDateTimeString(),
        'status' => 'published',
        'visibility' => 'public',
        'category_id' => 1,
        'cover_image' => UploadedFile::fake()->image('cover.jpg')->size(3000), // 🔹 3MB (excede los 2048KB)
    ];

    $request = new UpdatePostRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('cover_image'))->toBe('The cover image field must not be greater than 2048 kilobytes.');
});

it('fails validation when tags contain an invalid id', function () {
    // Arrange
    $category = \App\Models\Category::factory()->create();
    $tags = [9999, 8888];

    $data = [
        'title' => 'Updated Post Title',
        'body' => 'This is an updated post body.',
        'published_at' => now()->toDateTimeString(),
        'status' => 'published',
        'visibility' => 'public',
        'category_id' => $category->id,
        'tags' => $tags,
    ];

    $request = new UpdatePostRequest;

    // Act
    $validator = Validator::make($data, $request->rules());

    // Assert
    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('tags.0'))->toBe('The selected tags.0 is invalid.');
});
