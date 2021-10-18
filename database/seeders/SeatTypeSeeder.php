<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seat_types')->insert([
            'created_at' => now(),
            'updated_at' => now(),
            'name' => 'Arbeidsplass',
            'description' => 'Pult med stol',
        ]);
    }
}
