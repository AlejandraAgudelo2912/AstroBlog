<?php

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

it('generates tokens for admin and user', function () {
    // Arrange
    Role::firstOrCreate(['name' => 'admin']);
    Role::firstOrCreate(['name' => 'user']);

    $admin = User::factory()->create();
    $user = User::factory()->create();

    // Asignar roles
    $admin->assignRole('admin');
    $user->assignRole('user');

    // Act
    Artisan::call('tokens:generate');

    $output = Artisan::output();

    // Assert
    expect($output)->toContain('Admin Token:');
    expect($output)->toContain('User Token:');

});

it('shows an error if no admin or user exists', function () {
    // Arrange
    User::query()->delete();

    // Act
    $this->artisan('tokens:generate')
        ->expectsOutputToContain('No se encontraron usuarios con los roles especificados.')
        ->assertExitCode(0);
});
