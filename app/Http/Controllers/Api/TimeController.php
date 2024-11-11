<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Time;
use Illuminate\Support\Facades\DB;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupera tutti i dati dalla tabella 'times'
        $times = DB::table('times')->get();
        
        // // Raggruppa i dati per giorno della settimana
        // $groupedTimes = [];

        // foreach ($times as $time) {
        //     // Se il giorno della settimana non è ancora stato aggiunto all'array, lo aggiungiamo
        //     if (!isset($groupedTimes[$time->day_of_week])) {
        //         $groupedTimes[$time->day_of_week] = [];
        //     }

        //     // Aggiungiamo l'orario di inizio e fine per il giorno
        //     $groupedTimes[$time->day_of_week][] = [
        //         'start' => substr($time->start_time, 0, 5), // formato "HH:MM"
        //         'end' => substr($time->end_time, 0, 5),
        //     ];
        // }

        return response()->json([
            'status' => 'success',
            'message' => 'OK',
            'times' => $times
        ]);
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
            'field_id' => 'required',
            'day_of_week' => 'required|string|max:255',
           'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s',
        ]);

        $times = new Time();

        $times->field_id = $validateData['field_id'];
        $times->day_of_week = $validateData['day_of_week'];
        $times->start_time = $validateData['start_time'];
        $times->end_time = $validateData['end_time'];
        $times->save();

        return response()->json([
            'status' => 'success',
            'message' => 'OK',
            'results' => $times
        ], 201);
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
            'field_id' => 'required',
            'day_of_week' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s',
        ]);

        $times = Time::find($id);

        $times->field_id = $validateData['field_id'];
        $times->day_of_week = $validateData['day_of_week'];
        $times->start_time = $validateData['start_time'];
        $times->end_time = $validateData['end_time'];
        $times->save();
        return response()->json([
            'status' => 'success',
            'message' => 'OK',
            'results' => $times
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $times = Time::find($id); 
        $times->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'OK',
            'results' => $times
        ], 200);
    }
}
