<?php

use App\Models\ObservationPoint;
use App\Models\User;

beforeEach(function () {

    $this->admin = User::factory()->create();
    $this->admin->syncRoles(['admin']);

    $this->user = User::factory()->create();
    $this->user->assignRole('user');

    $this->god = User::factory()->create();
    $this->god->assignRole('god');

    $this->observationPoint = ObservationPoint::factory()->create();
});

it('allows god user to do anything', function () {
    expect(Gate::forUser($this->god)->allows('viewAny', ObservationPoint::class))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('view', $this->observationPoint))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('create', ObservationPoint::class))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('update', $this->observationPoint))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('delete', $this->observationPoint))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('restore', $this->observationPoint))->toBeTrue()
        ->and(Gate::forUser($this->god)->allows('forceDelete', $this->observationPoint))->toBeTrue();
});

it('allows admins and users to create observation points', function () {
    expect(Gate::forUser($this->admin)->allows('create', ObservationPoint::class))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('create', ObservationPoint::class))->toBeTrue();
});

it('allows admins to update observation points', function () {
    expect(Gate::forUser($this->admin)->allows('update', $this->observationPoint))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('update', $this->observationPoint))->toBeFalse();
});

it('allows only admins to delete observation points', function () {
    expect(Gate::forUser($this->admin)->allows('delete', $this->observationPoint))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('delete', $this->observationPoint))->toBeFalse();
});

it('allows only admins to restore observation points', function () {
    expect(Gate::forUser($this->admin)->allows('restore', $this->observationPoint))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('restore', $this->observationPoint))->toBeFalse();
});

it('allows only admins to force delete observation points', function () {
    expect(Gate::forUser($this->admin)->allows('forceDelete', $this->observationPoint))->toBeTrue()
        ->and(Gate::forUser($this->user)->allows('forceDelete', $this->observationPoint))->toBeFalse();
});
