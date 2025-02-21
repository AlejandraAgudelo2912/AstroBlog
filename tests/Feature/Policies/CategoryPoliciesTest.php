<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->admin = User::factory()->create()->assignRole('admin');
    $this->user = User::factory()->create()->assignRole('user');
    $this->god = User::factory()->create()->assignRole('god');

    $this->category = Category::factory()->create();
});

it('allows god user to do anything', function () {
    expect(Gate::forUser($this->god)->allows('viewAny', Category::class))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('view', $this->category))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('create', Category::class))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('update', $this->category))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('delete', $this->category))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('restore', $this->category))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('forceDelete', $this->category))->toBeTrue();
});

it('allows any user to view any category', function () {
    expect(Gate::forUser($this->user)->allows('viewAny', Category::class))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('view', $this->category))->toBeTrue();
});

it('allows only admins to create categories', function () {
    expect(Gate::forUser($this->admin)->allows('create', Category::class))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('create', Category::class))->toBeFalse();
});

it('allows only admins to update categories', function () {
    expect(Gate::forUser($this->admin)->allows('update', $this->category))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('update', $this->category))->toBeFalse();
});

it('allows only admins to delete categories', function () {
    expect(Gate::forUser($this->admin)->allows('delete', $this->category))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('delete', $this->category))->toBeFalse();
});

it('allows only admins to restore categories', function () {
    expect(Gate::forUser($this->admin)->allows('restore', $this->category))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('restore', $this->category))->toBeFalse();
});

it('allows only admins to force delete categories', function () {
    expect(Gate::forUser($this->admin)->allows('forceDelete', $this->category))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('forceDelete', $this->category))->toBeFalse();
});

