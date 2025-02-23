<?php

use App\Events\UserUnverifiedFor24HoursEvent;
use App\Models\User;
use Illuminate\Support\Carbon;

it('dispatches event for unverified users', function () {
    // Arrange
    $unverifiedUser = User::factory()->create([
        'email_verified_at' => null,
        'created_at' => Carbon::now()->subDays(2)
    ]);

    $verifiedUser = User::factory()->create([
        'email_verified_at' => now(),
        'created_at' => Carbon::now()->subDays(2)
    ]);

    Event::fake();

    // Act
    Artisan::call('verification:send');

    // Assert
    Event::assertDispatched(UserUnverifiedFor24HoursEvent::class, function ($event) use ($unverifiedUser) {
        return $event->user->id === $unverifiedUser->id;
    });

    Event::assertNotDispatched(UserUnverifiedFor24HoursEvent::class, function ($event) use ($verifiedUser) {
        return $event->user->id === $verifiedUser->id;
    });

    expect(Artisan::output())->toContain('Recordatorios de verificación enviados correctamente.');
});

it('does not dispatch event if no unverified users', function () {
    // Arrange
    User::factory()->create([
        'email_verified_at' => now(),
        'created_at' => Carbon::now()->subDays(2)
    ]);

    Event::fake();

    // Act
    Artisan::call('verification:send');

    // Assert
    Event::assertNotDispatched(UserUnverifiedFor24HoursEvent::class);

    expect(Artisan::output())->toContain('Recordatorios de verificación enviados correctamente.');
});
