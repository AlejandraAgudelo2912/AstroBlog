<?php

it('executes the all:clear command successfully', function () {
    // Act
    $this->artisan('all:clear')
        ->expectsOutput('Borrando caché...')
        ->expectsOutput('Config cache cleared.')
        ->expectsOutput('Route cache cleared.')
        ->expectsOutput('View cache cleared.')
        ->expectsOutput('Application cache cleared.')
        ->expectsOutput('¡Toda la caché ha sido eliminada con éxito!')
        ->assertExitCode(0);
});
