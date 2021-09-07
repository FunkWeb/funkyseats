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
        \App\Models\User::factory(10)->create();

        $rooms = \App\Models\Room::factory(2)->create();
        \App\Models\Seat::factory(10)->create();
        //Requires users and seats to not crash
        \App\Models\Booking::factory(4)->create();
    }
}
