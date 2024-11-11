<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Recupera tutti gli id dei campi (fields)
        $fieldIds = DB::table('fields')->pluck('id');
        
        // Giorni della settimana
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        
        foreach ($fieldIds as $fieldId) {
            foreach ($daysOfWeek as $day) {
                // Genera orari casuali di inizio e fine
                
                $startHour = rand(8, 10); 
                $endHour = rand(18, 22);

                $startTime = sprintf('%02d:00:00', $startHour);
                $endTime = sprintf('%02d:00:00', $endHour);

                DB::table('times')->insert([
                    'field_id' => $fieldId,
                    'day_of_week' => $day,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
