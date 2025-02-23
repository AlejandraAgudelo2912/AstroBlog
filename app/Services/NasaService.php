<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NasaService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('NASA_API_KEY', 'DEMO_KEY');
    }

    public function getAstronomyPicture()
    {
        $response = Http::get('https://api.nasa.gov/planetary/apod', [
            'api_key' => $this->apiKey,
        ]);

        return $response->json();
    }

    public function getAsteroids()
    {
        $response = Http::get('https://api.nasa.gov/neo/rest/v1/feed', [
            'start_date' => now()->subDays(1)->toDateString(),
            'end_date' => now()->toDateString(),
            'api_key' => $this->apiKey,
        ]);

        return $response->json();
    }
}
