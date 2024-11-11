<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Field;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fields = Field::with('times')->get();
    
        // Aggiungiamo la logica di raggruppamento degli orari per giorno della settimana
        foreach ($fields as $field) {
            // Raggruppa i tempi per giorno della settimana
            $groupedTimes = [];
    
            foreach ($field->times as $time) {
                // Se il giorno della settimana non è già stato aggiunto, creiamo un array vuoto per quel giorno
                if (!isset($groupedTimes[$time->day_of_week])) {
                    $groupedTimes[$time->day_of_week] = [];
                }
    
                // Aggiungiamo l'orario di inizio e fine
                $groupedTimes[$time->day_of_week][] = [
                    'start' => substr($time->start_time, 0, 5), // formato "HH:MM"
                    'end' => substr($time->end_time, 0, 5),
                ];
            }
    
            // Aggiungi l'array di orari raggruppati al campo
            $field->grouped_times = $groupedTimes;
            $field->special_days = json_decode($field->special_days);
        }
    

        return response()->json([
            'status' => 'success',
            'message' => 'OK',
            'results' => $fields
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
            'name' => 'required|string|max:255',  
            'active' =>  'required|boolean', 
            'price' => 'required|numeric',              
            'member_price' => 'required|numeric',
            'special_days' => 'nullable',
        ]);

        $fields = new Field();

        $fields->name = $validateData['name'];
        $fields->active = $validateData['active'];
        $fields->price = $validateData['price'];
        $fields->member_price = $validateData['member_price'];
        $fields->special_days = $validateData['special_days'];

        $fields->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'OK',
            'results' => $fields
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
            'name' => 'required|string|max:255',  
            'active' =>  'required|boolean', 
            'price' => 'required|numeric',              
            'member_price' => 'required|numeric',
            'special_days' => 'nullable|array',
        ]);

        $fields = Field::find($id);

        $fields->name = $validateData['name'];
        $fields->active = $validateData['active'];
        $fields->price = $validateData['price'];
        $fields->member_price = $validateData['member_price'];
        $fields->special_days = $validateData['special_days'];

        $fields->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'OK',
            'results' => $fields
        ], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fields = Field::find($id);
        $fields->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'OK',
            'results' => $fields
        ], 200);
    }
}
