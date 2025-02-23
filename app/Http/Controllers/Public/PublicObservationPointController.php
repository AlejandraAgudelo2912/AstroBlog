<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ObservationPoint;

class PublicObservationPointController extends Controller
{
    public function index()
    {
        $points = ObservationPoint::all();

        return view('public.map.index', compact('points'));
    }
}
