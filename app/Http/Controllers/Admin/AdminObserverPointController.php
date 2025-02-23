<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreObservationPointRequest;
use App\Http\Requests\UpdateObservationPointRequest;
use App\Models\ObservationPoint;

class AdminObserverPointController extends Controller
{
    public function index()
    {
        $points = ObservationPoint::all();

        return view('admin.map.index', compact('points'));
    }

    public function store(StoreObservationPointRequest $request)
    {
        $request->validated();

        ObservationPoint::create($request->all());

        return redirect()->route('admin.observers.index')->with('success', 'Punto de observación agregado.');
    }
    //
    //    public function update(UpdateObservationPointRequest $request, ObservationPointForm $observationPoint)
    //    {
    //        $request->validated();
    //
    //        $observationPoint->update($request->all());
    //
    //        return redirect()->route('admin.observers.index')->with('success', 'Punto de observación actualizado.');
    //    }
    //
    //    public function destroy(ObservationPointForm $observationPoint)
    //    {
    //        $observationPoint->delete();
    //
    //        return redirect()->route('admin.observers.index')->with('success', 'Punto de observación eliminado.');
    //    }
}
