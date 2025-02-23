<?php

use Illuminate\Support\Facades\File;

it('displays a message when no logs are found', function () {
    // Arrange
    File::shouldReceive('exists')
        ->with(storage_path('logs'))
        ->andReturn(false);

    // Act & Assert
    $this->artisan('logs:clear')
        ->expectsOutput('No hay logs para eliminar.')
        ->assertExitCode(0);
});

it('deletes all log files successfully', function () {
    // Arrange: Crea archivos de logs temporales en storage/logs
    $logPath = storage_path('logs');

    if (!File::exists($logPath)) {
        File::makeDirectory($logPath, 0755, true);
    }

    $logFiles = [
        $logPath . '/laravel.log',
        $logPath . '/error.log',
    ];

    foreach ($logFiles as $file) {
        File::put($file, 'Contenido de prueba');
    }

    foreach ($logFiles as $file) {
        expect(File::exists($file))->toBeTrue();
    }

    // Act
    $this->artisan('logs:clear')
        ->expectsOutput('Todos los logs han sido eliminados correctamente.')
        ->assertExitCode(0);

    // Assert
    foreach ($logFiles as $file) {
        expect(File::exists($file))->toBeFalse();
    }
});
