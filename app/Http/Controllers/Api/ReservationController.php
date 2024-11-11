<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with('user', 'field')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'OK',
            'results' => $reservations
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'user_id' => 'required',
            'field_id' => 'required',
            'start_time' => 'required|dateTime',
            'end_time' => 'required|dateTime',
            'number_of_people' => 'required|integer',
        ]);

        $reservations = new Reservation();

        $reservations->user_id = $validateData['user_id'];
        $reservations->field_id = $validateData['field_id'];
        $reservations->start_time = $validateData['start_time'];
        $reservations->end_time = $validateData['end_time'];
        $reservations->number_of_people = $validateData['number_of_people'];

        $reservations->save();
        return response()->json([
            'status' => 'success',
            'message' => 'OK',
            'results' => $reservations
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'user_id' => 'required',
            'field_id' => 'required',
            'start_time' => 'required|dateTime',
            'end_time' => 'required|dateTime',
            'number_of_people' => 'required|integer',
        ]);

        $reservations = Reservation::find($id);

        $reservations->user_id = $validateData['user_id'];
        $reservations->field_id = $validateData['field_id'];
        $reservations->start_time = $validateData['start_time'];
        $reservations->end_time = $validateData['end_time'];
        $reservations->number_of_people = $validateData['number_of_people'];

        $reservations->save();
        return response()->json([
            'status' => 'success',
            'message' => 'OK',
            'results' => $reservations

        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservations = Reservation::find($id); 
        $reservations->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'OK',
            'results' => $reservations
        ],200);
    }
}
