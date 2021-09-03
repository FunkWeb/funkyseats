<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\room;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Room::factory(1)->create();
        //Seat seeding has hardcoded room_id = 1
        \App\Models\Seat::factory(10)->create();
    }
}
