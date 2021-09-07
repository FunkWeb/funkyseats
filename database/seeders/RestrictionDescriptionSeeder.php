<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestrictionDescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restriction_descriptions')->insert([
            'created_at' => now(),
            'updated_at' => now(),
            'name' => 'approval',
            'description' => 'This booking needs be be approved before reservation is complete',
            'general' => true,
        ]);
        DB::table('restriction_descriptions')->insert([
            'created_at' => now(),
            'updated_at' => now(),
            'name' => 'deactivated',
            'description' => 'This seat is deactivated and cannot be booked',
            'general' => true,
        ]);
        DB::table('restriction_descriptions')->insert([
            'created_at' => now(),
            'updated_at' => now(),
            'name' => 'time',
            'description' => 'This seat is time restricted and can only be booked from: ',
            'general' => true,
        ]);
    }
}
