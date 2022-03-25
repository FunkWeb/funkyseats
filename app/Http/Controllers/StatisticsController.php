<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function seatBookingStatistics(Request $request, $id = null)
    {

        //Hard coded current month
        $thisMonth = now()->month;

        $dbRows = Booking::select(
            DB::raw("DATE(STR_TO_DATE(`from`, '%Y-%m-%d %H:%i:%s')) as date"),
            DB::raw("count(*) as total"),
            DB::raw("SUM(case when HOUR(STR_TO_DATE(`from`, '%Y-%m-%d %H:%i:%s'))=8 AND HOUR(STR_TO_DATE(`to`, '%Y-%m-%d %H:%i:%s'))=16 then 1 else 0 end) as whole"),
            DB::raw("SUM(case when 
                (HOUR(STR_TO_DATE(`from`, '%Y-%m-%d %H:%i:%s'))=8 AND HOUR(STR_TO_DATE(`to`, '%Y-%m-%d %H:%i:%s'))=12) 
                OR
                (HOUR(STR_TO_DATE(`from`, '%Y-%m-%d %H:%i:%s'))=12 AND HOUR(STR_TO_DATE(`to`, '%Y-%m-%d %H:%i:%s'))=16) 
                then 1 else 0 end) as half")
        )
            ->groupBy(DB::raw("DATE(STR_TO_DATE(`from`, '%Y-%m-%d %H:%i:%s'))"))
            ->whereRaw("MONTH(STR_TO_DATE(`from`, '%Y-%m-%d %H:%i:%s')) = ?", [$thisMonth]);

        //Needs to check against incoming variable for room 
        if ($id) {
            $dbRows->whereHas('seat', function ($q) use ($id) {
                $q->where('room_id', '=', $id);
            });
        }

        if ($id) {
            $countSeat = Seat::where('room_id', $id)->count();
        } else {
            $countSeat = Seat::all()->count();
        }

        $thisWeek = [
            "total bookings" => 0,
            "low booking" => PHP_INT_MAX,
            "high bookings" => 0,
            "average bookings" => 0,
            "halfdays" => [],
            "wholedays" => []
        ];
        $countThisWeek = 0;

        $lastWeek = [
            "total bookings" => 0,
            "low booking" => PHP_INT_MAX,
            "high bookings" => 0,
            "average bookings" => 0,
            "halfdays" => [],
            "wholedays" => []
        ];

        $countLastWeek = 0;

        $month = [
            "total bookings" => 0,
            "low booking" => PHP_INT_MAX,
            "high bookings" => 0,
            "average bookings" => 0,
            "halfdays" => [],
            "wholedays" => []
        ];

        $countMonth = 0;

        $dbRows = $dbRows->get();

        foreach ($dbRows as $row) {
            if (Carbon::parse($row['date'])->month == now()->month) {
                //month data
                $month['total bookings'] += $row['total'];
                if ($month['low booking'] > $row['total']) {
                    $month['low booking'] = $row['total'];
                }
                if ($month['high bookings'] < $row['total']) {
                    $month['high bookings'] = $row['total'];
                }
                $month['halfdays'] = array_merge($month['halfdays'], [['x' => Carbon::parse($row['date'])->isoFormat('D.MMM'), 'y' => $row['half']]]);
                $month['wholedays'] = array_merge($month['wholedays'], [['x' => Carbon::parse($row['date'])->isoFormat('D.MMM'), 'y' => $row['whole']]]);
                $countMonth += 1;

                //current week data
                if (Carbon::parse($row['date']) < now()->endOfWeek() && Carbon::parse($row['date']) > now()->startOfWeek()) {
                    $thisWeek['total bookings'] += $row['total'];
                    if ($thisWeek['low booking'] > $row['total']) {
                        $thisWeek['low booking'] = $row['total'];
                    }
                    if ($thisWeek['high bookings'] < $row['total']) {
                        $thisWeek['high bookings'] = $row['total'];
                    }
                    $thisWeek['halfdays'] = array_merge($thisWeek['halfdays'], [['x' => Carbon::parse($row['date'])->isoFormat('D.MMM'), 'y' => $row['half']]]);
                    $thisWeek['wholedays'] = array_merge($thisWeek['wholedays'], [['x' => Carbon::parse($row['date'])->isoFormat('D.MMM'), 'y' => $row['whole']]]);
                    $countThisWeek += 1;
                }
                //last weeks data
                if (Carbon::parse($row['date']) < now()->endOfWeek()->subDays(7) && Carbon::parse($row['date']) > now()->startOfWeek()->subDays(7)) {
                    $lastWeek['total bookings'] += $row['total'];
                    if ($lastWeek['low booking'] > $row['total']) {
                        $lastWeek['low booking'] = $row['total'];
                    }
                    if ($lastWeek['high bookings'] < $row['total']) {
                        $lastWeek['high bookings'] = $row['total'];
                    }
                    $lastWeek['halfdays'] = array_merge($lastWeek['halfdays'], [['x' => Carbon::parse($row['date'])->isoFormat('D.MMM'), 'y' => $row['half']]]);
                    $lastWeek['wholedays'] = array_merge($lastWeek['wholedays'], [['x' => Carbon::parse($row['date'])->isoFormat('D.MMM'), 'y' => $row['whole']]]);
                    $countLastWeek += 1;
                }
            }
        }

        //making sure not to divide by 0
        $countThisWeek = $countThisWeek == 0 ? 1 : $countThisWeek;
        $countLastWeek = $countLastWeek == 0 ? 1 : $countLastWeek;
        $countMonth = $countMonth == 0 ? 1 : $countMonth;

        $thisWeek['low booking'] = $thisWeek['low booking'] == PHP_INT_MAX ? 0 : $thisWeek['low booking'];
        $lastWeek['low booking'] = $lastWeek['low booking'] == PHP_INT_MAX ? 0 : $lastWeek['low booking'];
        $month['low booking'] = $month['low booking'] == PHP_INT_MAX ? 0 : $month['low booking'];

        $thisWeek['average bookings'] = $thisWeek['total bookings'] / $countThisWeek;
        $lastWeek['average bookings'] = $lastWeek['total bookings'] / $countLastWeek;
        $month['average bookings'] =  $month['total bookings'] / $countMonth;

        $thisWeek['average bookings'] = number_format($thisWeek['average bookings']);
        $lastWeek['average bookings'] = number_format($lastWeek['average bookings']);
        $month['average bookings'] = number_format($month['average bookings']);

        $jsonStats = [
            "thisweek" => $thisWeek,
            "lastweek" => $lastWeek,
            "month" => $month,
            "seatcount" => $countSeat,
        ];

        $jsonStats = json_encode($jsonStats);
        return view('pages.admin.stats', ['stats' => $jsonStats, 'rooms' => Room::all(), 'selectedRoom' => $id ?? null]);
    }
}
