<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\EonetService;
use App\Services\NasaService;

class PageHomeController extends Controller
{
    protected $nasaService;
    protected $eonetService;

    public function __construct(NasaService $nasaService, EonetService $eonetService)
    {
        $this->nasaService = $nasaService;
        $this->eonetService = $eonetService;
    }

    public function index()
    {
        $apod = $this->nasaService->getAstronomyPicture();
        $events = array_slice($this->eonetService->getEvents()['events'], 0, 3);
        $asteroids = array_slice($this->nasaService->getAsteroids()['near_earth_objects'], 0, 1);

        $topPosts =  Post::featured()->latest()->take(5)->get(); ;

        return view('welcome', compact('apod', 'events', 'asteroids', 'topPosts'));
    }
}
