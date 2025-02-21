<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

beforeEach(function () {

    $this->admin = User::factory()->create()->assignRole('admin');
    $this->user = User::factory()->create()->assignRole('user');
    $this->god = User::factory()->create()->assignRole('god');
    $this->postOwner = User::factory()->create()->assignRole('user');

    $this->post = Post::factory()->create(['user_id' => $this->postOwner->id, 'visibility' => 'public']);
    $this->privatePost = Post::factory()->create(['user_id' => $this->postOwner->id, 'visibility' => 'private']);
});

it('allows anyone to view any post ', function () {
    expect(Gate::forUser($this->user)->allows('viewAny', Post::class))->toBeTrue();
});

it('allows god user to do anything', function () {
    expect(Gate::forUser($this->god)->allows('viewAny', Post::class))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('view', $this->post))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('create', Post::class))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('update', $this->post))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('delete', $this->post))->toBeTrue();
});

it('allows any user to view public posts', function () {
    expect(Gate::forUser($this->user)->allows('view', $this->post))->toBeTrue();
});

it('prevents users from viewing private posts unless they are the owner or admin', function () {
    expect(Gate::forUser($this->user)->allows('view', $this->privatePost))->toBeFalse()
        ->and(Gate::forUser($this->postOwner)->allows('view', $this->privatePost))->toBeTrue()
        ->and(Gate::forUser($this->admin)->allows('view', $this->privatePost))->toBeTrue();
});

it('allows users with the correct role to create posts', function () {
    expect(Gate::forUser($this->user)->allows('create', Post::class))->toBeTrue()
        ->and(Gate::forUser($this->admin)->allows('create', Post::class))->toBeTrue();
});

it('prevents a user from updating posts they do not own', function () {
    expect(Gate::forUser($this->user)->allows('update', $this->post))->toBeFalse();
});

it('allows the owner to update their own post', function () {
    expect(Gate::forUser($this->postOwner)->allows('update', $this->post))->toBeTrue();
});

it('allows an admin to update any post', function () {
    expect(Gate::forUser($this->admin)->allows('update', $this->post))->toBeTrue();
});

it('allows the owner to delete their own post', function () {
    expect(Gate::forUser($this->postOwner)->allows('delete', $this->post))->toBeTrue();
});

it('allows an admin to delete any post', function () {
    expect(Gate::forUser($this->admin)->allows('delete', $this->post))->toBeTrue();
});

it('prevents users from deleting posts they do not own', function () {
    expect(Gate::forUser($this->user)->allows('delete', $this->post))->toBeFalse();
});

it('allows an admin to restore a post', function () {
    expect(Gate::forUser($this->admin)->allows('restore', $this->post))->toBeTrue();
});

it('prevents normal users from restoring posts', function () {
    expect(Gate::forUser($this->user)->allows('restore', $this->post))->toBeFalse();
});

it('allows an admin to force delete a post', function () {
    expect(Gate::forUser($this->admin)->allows('forceDelete', $this->post))->toBeTrue();
});

it('prevents normal users from force deleting posts', function () {
    expect(Gate::forUser($this->user)->allows('forceDelete', $this->post))->toBeFalse();
});
