<?php

namespace App\Http\Controllers;

use App\Services\NasaService;

class NasaController extends Controller
{
    protected $astronomyService;

    public function __construct(NasaService $astronomyService)
    {
        $this->astronomyService = $astronomyService;
    }

    /**
     * Mostrar la imagen astronómica del día
     */
    public function showPicture()
    {
        $data = $this->astronomyService->getAstronomyPicture();

        return view('nasa.picture', compact('data'));
    }

    /**
     * Mostrar los asteroides cercanos a la Tierra
     */
    public function showAsteroids()
    {
        $data = $this->astronomyService->getAsteroids();

        return view('nasa.asteroids', compact('data'));
    }
}
