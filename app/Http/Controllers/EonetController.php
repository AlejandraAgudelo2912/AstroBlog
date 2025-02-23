<?php

namespace App\Http\Controllers;

use App\Services\EonetService;

class EonetController extends Controller
{
    protected $eonetService;

    public function __construct(EonetService $eonetService)
    {
        $this->eonetService = $eonetService;
    }

    public function index()
    {
        $events = $this->eonetService->getEvents();

        return view('eonet.index', compact('events'));
    }

    public function show($id)
    {
        $events = $this->eonetService->getEvents();

        $event = collect($events['events'])->firstWhere('id', $id);

        return view('eonet.show', compact('event'));
    }
}
