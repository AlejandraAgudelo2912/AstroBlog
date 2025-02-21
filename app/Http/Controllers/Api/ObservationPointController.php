<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreObservationPointRequest;
use App\Http\Requests\UpdateObservationPointRequest;
use App\Models\ObservationPoint;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ObservationPointController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'observation_points' => ObservationPoint::all()
        ], Response::HTTP_OK);
    }

    public function show(ObservationPoint $observationPoint)
    {
        return response()->json([
            'success' => true,
            'observation_point' => $observationPoint
        ], Response::HTTP_OK);
    }

    public function store(StoreObservationPointRequest $request)
    {
        $request->validated();

        $observationPoint = ObservationPoint::create(
            [
                'name' => $request->name,
                'description' => $request->description,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'user_id' => Auth::id(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Punto de observación creado correctamente.',
            'observation_point' => $observationPoint
        ], Response::HTTP_CREATED);
    }


    public function update(UpdateObservationPointRequest $request, ObservationPoint $observationPoint)
    {
        $request->validated();

        $observationPoint->update(
            [
                'name' => $request->name,
                'description' => $request->description,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Punto de observación actualizado correctamente.',
            'observation_point' => $observationPoint
        ], Response::HTTP_OK);
    }

    public function destroy(ObservationPoint $observationPoint)
    {
        $observationPoint->delete();

        return response()->json([
            'success' => true,
            'message' => 'Punto de observación eliminado correctamente.'
        ], Response::HTTP_OK);
    }
}
