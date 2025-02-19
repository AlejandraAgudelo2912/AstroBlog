<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ClearAllCacheCommand extends Command
{
    protected $signature = 'all:clear';

    protected $description = 'Borra toda la caché de la aplicación, incluyendo rutas, vistas, configuración y permisos.';

    public function handle()
    {
        $this->info('Borrando caché...');

        Artisan::call('config:clear');
        $this->info('Config cache cleared.');

        Artisan::call('route:clear');
        $this->info('Route cache cleared.');

        Artisan::call('view:clear');
        $this->info('View cache cleared.');

        Artisan::call('cache:clear');
        $this->info('Application cache cleared.');

        if (class_exists(\Spatie\Permission\PermissionRegistrar::class)) {
            Artisan::call('permission:cache-reset');
            $this->info('Permission cache cleared.');
        }

        $this->info('¡Toda la caché ha sido eliminada con éxito!');
    }
}
