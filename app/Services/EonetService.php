<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class EonetService
{
    protected $baseUrl = 'https://eonet.gsfc.nasa.gov/api/v3/events';

    public function __construct() {}

    public function getEvents()
    {
        $response = Http::get($this->baseUrl, [
            'status' => 'open',
            'limit' => 10,
        ]);

        return $response->json();
    }
}
