<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreObservationPointRequest;
use App\Http\Requests\UpdateObservationPointRequest;
use App\Models\ObservationPoint;

class UserObservationPointController extends Controller
{
    public function index()
    {
        $points = ObservationPoint::all();
        return view('user.map.index', compact('points'));
    }

//    public function show(ObservationPointForm $observationPoint)
//    {
//        $this->authorize('view', $observationPoint);
//
//        return view('user.map.show', compact('observationPoint'));
//    }
//
//    public function create()
//    {
//        return view('user.map.create');
//    }
//
//    public function store(StoreObservationPointRequest $request)
//    {
//        $request->validated();
//
//        auth()->user()->observationPoints()->create($request->all());
//
//        return redirect()->route('user.observers.index')->with('success', 'Punto de observación agregado.');
//    }
//
//    public function edit(ObservationPointForm $observationPoint)
//    {
//        $this->authorize('update', $observationPoint);
//
//        return view('user.map.edit', compact('observationPoint'));
//    }
//
//    public function update(UpdateObservationPointRequest $request, ObservationPointForm $observationPoint)
//    {
//        $this->authorize('update', $observationPoint);
//
//        $request->validated();
//
//        $observationPoint->update($request->all());
//
//        return redirect()->route('user.observers.index')->with('success', 'Punto de observación actualizado.');
//    }
//
//    public function destroy(ObservationPointForm $observationPoint)
//    {
//        $this->authorize('delete', $observationPoint);
//
//        $observationPoint->delete();
//
//        return redirect()->route('user.observers.index')->with('success', 'Punto de observación eliminado.');
//    }
}
