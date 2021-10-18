<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\room;
use App\Models\SeatType;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $numberOfRooms = 4;
        \App\Models\User::factory(10)->create();

        $rooms = \App\Models\Room::factory($numberOfRooms)->create();

        $this->call(SeatTypeSeeder::class);
        for ($i = 1; $i <= $numberOfRooms; $i++) {
            \App\Models\Seat::factory(10)->create(["room_id" => $i]);
        }

        //Requires users and seats to not crash
        \App\Models\Booking::factory(4)->create();

        //Creates 3 standardized descriptions and 4 random non standard
        $this->call(RestrictionDescriptionSeeder::class);
        \App\Models\RestrictionDescription::factory(4)->create();

        \App\Models\BookingRestriction::factory(20)->create();
        \App\Models\TimeRestriction::factory(3)->create();

        \App\Models\SeatRestriction::factory(10)->create();

        \App\Models\Equipment::factory(50)->create();
        \App\Models\SeatEquipment::factory(50)->create();

        DB::table('roles')->insert([
            'created_at' => now(),
            'updated_at' => now(),
            'name' => 'admin',
        ]);
    }
}
