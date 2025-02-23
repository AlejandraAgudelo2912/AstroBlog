<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\Traits\DatabaseHelpers;

uses(DatabaseHelpers::class);

it('creates a database backup successfully', function () {
    // Arrange
    $this->disableForeignKeyChecks();

    DB::table('users')->insert([
        'name' => 'Test User',
        'email' => 'HwWlt@example.com',
        'password' => bcrypt('password'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $this->enableForeignKeyChecks();

    Storage::fake('local');

    // Act
    $this->artisan('backup:database')
        ->expectsOutputToContain('Backup saved at:')
        ->assertExitCode(0);

    // Assert
    $files = Storage::disk('local')->allFiles('backups');
    expect($files)->toHaveCount(1);

    $backupData = json_decode(Storage::disk('local')->get($files[0]), true);

    expect($backupData)->toHaveKey('users');

    expect($backupData['users'][0]['name'])->toBe('Test User');
});
