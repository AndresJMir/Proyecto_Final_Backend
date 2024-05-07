<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ChargingPoint;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ChargingPointController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return response()->json(ChargingPoint::with('user', 'proposals', 'ratings')->get());
        // return ChargingPoint::all();

        // $chargingPoints = ChargingPoint::with('user', 'proposals', 'ratings')->get();
        // return response()->json($chargingPoints);

        // $chargingPoints = ChargingPoint::select('id', 'name', 'address', 'latitude', 'longitude', 'type', 'power', 'created_by', 'status')
        //     ->with('user', 'proposals', 'ratings')
        //     ->get();
        // return response()->json($chargingPoints);

        $chargingPoints = ChargingPoint::with('ratings')->get();
        return response()->json($chargingPoints);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:200',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'type' => 'required|string|max:50',
            'power' => 'required|integer',
            'created_by' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $chargingPoint = ChargingPoint::create($request->all());
        return response()->json($chargingPoint, 201);
    }
    /**
     * Display the specified resource.
     * 
     * @param string $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function show(string $id)
    {
        $chargingPoint = ChargingPoint::with('user', 'proposals', 'ratings')->find($id);
        if (!$chargingPoint) {
            return response()->json(['message' => 'Punto de carga no encontrado'], 404);
        }
        return response()->json($chargingPoint);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \Illuminate\Http\Request  $request
     * @param string $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:100',
            'address' => 'sometimes|required|string|max:200',
            'latitude' => 'sometimes|required|numeric',
            'longitude' => 'sometimes|required|numeric',
            'type' => 'sometimes|required|string|max:50',
            'power' => 'sometimes|required|integer',
            'created_by' => 'sometimes|nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $chargingPoint = ChargingPoint::find($id);
        if (!$chargingPoint) {
            return response()->json(['message' => 'Punto de carga no encontrado'], 404);
        }

        $chargingPoint->update($request->all());
        return response()->json($chargingPoint, 200);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function destroy(string $id)
    {
        $chargingPoint = ChargingPoint::find($id);
        if (!$chargingPoint) {
            return response()->json(['message' => 'Punto de carga no encontrado'], 404);
        }
        $chargingPoint->delete();
        return response()->json(['message' => 'Punto de carga eliminado'], 200);
    }
}
