<?php

use App\Models\Tag;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->user->assignRole('admin');
    $this->actingAs($this->user);
});

it('renders the index page', function () {
    // Arrange
    Tag::factory()->count(3)->create();

    // Act
    $response = $this->get(route('admin.tags.index'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.tags.index');
    $response->assertViewHas('tags');
});

it('renders the create page', function () {
    // Act
    $response = $this->get(route('admin.tags.create'));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.tags.create');
});

it('stores a new tag successfully', function () {
    // Arrange
    $data = [
        'name' => 'New Tag',
        'slug' => 'new-tag',
    ];

    // Act
    $response = $this->post(route('admin.tags.store'), $data);

    // Assert
    $response->assertRedirect(route('admin.tags.index'));
    $this->assertDatabaseHas('tags', ['name' => 'New Tag']);
});

it('renders the show page for a tag', function () {
    // Arrange
    $tag = Tag::factory()->create();

    // Act
    $response = $this->get(route('admin.tags.show', $tag));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.tags.show');
    $response->assertViewHas('tag', $tag);
});

it('renders the edit page for a tag', function () {
    // Arrange
    $tag = Tag::factory()->create();

    // Act
    $response = $this->get(route('admin.tags.edit', $tag));

    // Assert
    $response->assertStatus(200);
    $response->assertViewIs('admin.tags.edit');
    $response->assertViewHas('tag', $tag);
});

it('updates a tag successfully', function () {
    // Arrange
    $tag = Tag::factory()->create();
    $newData = [
        'name' => 'Updated Tag Name',
        'slug' => 'updated-tag-name',
    ];

    // Act
    $response = $this->put(route('admin.tags.update', $tag), $newData);

    // Assert
    $response->assertRedirect(route('admin.tags.index'));
    $this->assertDatabaseHas('tags', ['name' => 'Updated Tag Name']);
});

it('deletes a tag successfully', function () {
    // Arrange
    $tag = Tag::factory()->create();

    // Act
    $response = $this->delete(route('admin.tags.destroy', $tag));

    // Assert
    $response->assertRedirect(route('admin.tags.index'));
    $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
});
