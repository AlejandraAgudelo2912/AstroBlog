<?php

use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

beforeEach(function () {

    $this->admin = User::factory()->create()->assignRole('admin');
    $this->user = User::factory()->create()->assignRole('user');
    $this->god = User::factory()->create()->assignRole('god');
    $this->commentOwner = User::factory()->create()->assignRole('user');

    $this->comment = Comment::factory()->create(['user_id' => $this->commentOwner->id]);
});

it('allows god user to do anything', function () {
    expect(Gate::forUser($this->god)->allows('viewAny', Comment::class))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('view', $this->comment))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('create', Comment::class))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('update', $this->comment))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('delete', $this->comment))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('restore', $this->comment))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('forceDelete', $this->comment))->toBeTrue();
});

it('allows any user to view any comment', function () {
    expect(Gate::forUser($this->user)->allows('viewAny', Comment::class))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('view', $this->comment))->toBeTrue();
});

it('allows only users and admins to create comments', function () {
    expect(Gate::forUser($this->user)->allows('create', Comment::class))->toBeTrue()
        ->and(Gate::forUser($this->admin)->allows('create', Comment::class))->toBeTrue();
});

it('prevents unauthorized users from creating comments', function () {
    expect(Gate::forUser(null)->allows('create', Comment::class))->toBeFalse();
});

it('allows the owner to update their own comment', function () {
    expect(Gate::forUser($this->commentOwner)->allows('update', $this->comment))->toBeTrue();
});

it('allows an admin to update any comment', function () {
    expect(Gate::forUser($this->admin)->allows('update', $this->comment))->toBeTrue();
});

it('prevents a user from updating comments they do not own', function () {
    expect(Gate::forUser($this->user)->allows('update', $this->comment))->toBeFalse();
});

it('allows the owner to delete their own comment', function () {
    expect(Gate::forUser($this->commentOwner)->allows('delete', $this->comment))->toBeTrue();
});

it('allows an admin to delete any comment', function () {
    expect(Gate::forUser($this->admin)->allows('delete', $this->comment))->toBeTrue();
});

it('prevents a user from deleting comments they do not own', function () {
    expect(Gate::forUser($this->user)->allows('delete', $this->comment))->toBeFalse();
});

it('allows an admin to restore a comment', function () {
    expect(Gate::forUser($this->admin)->allows('restore', $this->comment))->toBeTrue();
});

it('prevents normal users from restoring comments', function () {
    expect(Gate::forUser($this->user)->allows('restore', $this->comment))->toBeFalse();
});

it('allows an admin to force delete a comment', function () {
    expect(Gate::forUser($this->admin)->allows('forceDelete', $this->comment))->toBeTrue();
});

it('prevents normal users from force deleting comments', function () {
    expect(Gate::forUser($this->user)->allows('forceDelete', $this->comment))->toBeFalse();
});
