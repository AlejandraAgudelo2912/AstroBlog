<?php

namespace Database\Seeders;

use App\Models\ObservationPoint;
use Illuminate\Database\Seeder;

class ObservationPointSeeder extends Seeder
{
    public function run(): void
    {
        ObservationPoint::factory(10)->create();
    }
}
