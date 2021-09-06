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

        //Create X rooms and give them 10 seats each
        $numberOfRooms = 2;
        $rooms = \App\Models\Room::factory($numberOfRooms)->create();
        for ($i = 1; $i <= $numberOfRooms; $i++) {
            \App\Models\Seat::factory(10)->create(["room_id" => $i]);
        }
    }
}
