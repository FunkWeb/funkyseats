<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function seat()
    {
        return $this->HasMany(Seat::class);
    }

    public static function withSeats()
    {
        return Room::withCount(['seat' => function ($q) {
            $q
                ->whereDoesntHave("booking", function ($query) {
                    $query
                        ->where('from',  '<=', Carbon::now('Europe/Oslo'))
                        ->where('to',  '>=', Carbon::now('Europe/Oslo'));
                });
        }])->get();
    }

    public static function withTodayBookings($id)
    {
        return Room::where('id', $id)
            ->with(['seat' => function ($query) {
                if (env('DB_CONNECTION') == "mysql") {
                    $query->orderByRaw('CHAR_LENGTH(seat_number)');
                } else {
                    $query->orderByRaw('LENGTH(seat_number)');
                }
                $query->orderBy('seat_number', 'asc');
            }, 'seat.booking' => function ($query) {
                $query
                    ->where('from', '>=', Carbon::today())
                    ->where('to', '<=', Carbon::today()->addDay());
                $query->with('user');
            }])
            ->get();
    }

    public static function withCurrentBookings($id, $date_time)
    {
        $time_from = Carbon::createFromDate($date_time)->addHours(8);
        $time_to = Carbon::createFromDate($date_time)->addHours(16);

        return Room::where('id', $id)
            ->with(['seat' => function ($query) {
                if (env('DB_CONNECTION') == "mysql") {
                    $query->orderByRaw('CHAR_LENGTH(seat_number)');
                } else {
                    $query->orderByRaw('LENGTH(seat_number)');
                }
                $query->orderBy('seat_number', 'asc');
            }, 'seat.booking' => function ($query) use ($time_from, $time_to) {
                $query
                    ->whereBetween('from', [$time_from, $time_to])
                    ->orWhereBetween('to', [$time_from, $time_to])
                    ->orderBy('from');
                $query->with('user');
            }])
            ->get();
    }
}
