<?php

namespace App\Console\Commands;

use App\Models\ObservationPoint;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldObservationsCommand extends Command
{
    protected $signature = 'observations:delete-old';

    protected $description = 'Eliminar puntos de observación sin actividad en más de un año.';

    public function handle()
    {
        $oneYearAgo = Carbon::now()->subYear();

        $inactiveObservations = ObservationPoint::where('updated_at', '<', $oneYearAgo);

        $count = $inactiveObservations->count();
        $deleted = $inactiveObservations->delete();

        if ($deleted) {
            $this->info("Se han eliminado $deleted puntos de observación antiguos.");
        } else {
            $this->info("No se encontraron puntos de observación antiguos para eliminar.");
        }
    }
}
