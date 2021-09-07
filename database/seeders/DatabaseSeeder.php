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

        //Creates 3 standardized descriptions and 4 random non standard
        $this->call(RestrictionDescription::class);
        \App\Models\RestrictionDescription::factory(4)->create();

        \App\Models\BookingRestriction::factory(20)->create();
        \App\Models\TimeRestriction::factory(3)->create();

        \App\Models\SeatRestrictions::factory(10)->create();
    }
}
