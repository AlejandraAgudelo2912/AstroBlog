<?php

use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

beforeEach(function () {

    $this->admin = User::factory()->create();
    $this->admin->syncRoles(['admin']);

    $this->user = User::factory()->create();
    $this->user->assignRole('user');

    $this->god = User::factory()->create();
    $this->god->assignRole('god');

    $this->tag = Tag::factory()->create();
});

it('allows god user to do anything', function () {
    expect(Gate::forUser($this->god)->allows('viewAny', Tag::class))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('view', $this->tag))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('create', Tag::class))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('update', $this->tag))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('delete', $this->tag))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('restore', $this->tag))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('forceDelete', $this->tag))->toBeTrue();
});

it('allows any user to view any tag', function () {
    $user = User::factory()->create();
    $user->assignRole('user');

    expect(Gate::forUser($this->user)->allows('view', [Tag::class, $this->tag]))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('view', $this->tag))->toBeTrue();
});

it('allows only admins to create tags', function () {
    expect(Gate::forUser($this->admin)->allows('create', Tag::class))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('create', Tag::class))->toBeFalse();
});

it('allows only admins to update tags', function () {
    expect(Gate::forUser($this->admin)->allows('update', $this->tag))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('update', $this->tag))->toBeFalse();
});

it('allows only admins to delete tags', function () {
    expect(Gate::forUser($this->admin)->allows('delete', $this->tag))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('delete', $this->tag))->toBeFalse();
});

it('allows only admins to restore tags', function () {
    expect(Gate::forUser($this->admin)->allows('restore', $this->tag))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('restore', $this->tag))->toBeFalse();
});

it('allows only admins to force delete tags', function () {
    expect(Gate::forUser($this->admin)->allows('forceDelete', $this->tag))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('forceDelete', $this->tag))->toBeFalse();
});
