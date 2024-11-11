<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fields')->insert([
            [
                'name' => 'Campo 1',
                'active' => true,
                'price' => 50.0,
                'member_price' => 40.0,
                'special_days' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Campo 2',
                'active' => true,
                'price' => 60.0,
                'member_price' => 50.0,
                'special_days' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Campo 3',
                'active' => true,
                'price' => 40.0,
                'member_price' => 30.0,
                'special_days' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
