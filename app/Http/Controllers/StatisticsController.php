<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function seatBookingStatistics()
    {
        $jsonStats = [

            "thisweek" => [
                "total bookings" => 123,
                "low booking" => 23,
                "high bookings" => 40,
                "average bookings" => 33,
                "halfdays" => [
                    ["x" => "3.jan", "y" => 20],
                    ["x" => "4.jan", "y" => 22],
                    ["x" => "5.jan", "y" => 21],
                    ["x" => "6.jan", "y" => 25],
                    ["x" => "7.jan", "y" => 27]
                ],
                "wholedays" => [
                    ["x" => "3.jan", "y" => 32],
                    ["x" => "4.jan", "y" => 36],
                    ["x" => "5.jan", "y" => 36],
                    ["x" => "6.jan", "y" => 33],
                    ["x" => "7.jan", "y" => 34]
                ]
            ],

            "lastweek" => [
                "total bookings" => 123,
                "low booking" => 23,
                "high bookings" => 40,
                "average bookings" => 33,
                "halfdays" => [
                    ["x" => "3.jan", "y" => 20],
                    ["x" => "4.jan", "y" => 22],
                    ["x" => "5.jan", "y" => 21],
                    ["x" => "6.jan", "y" => 25],
                    ["x" => "7.jan", "y" => 26],
                ],
                "wholedays" => [
                    ["x" => "3.jan", "y" => 32],
                    ["x" => "4.jan", "y" => 36],
                    ["x" => "5.jan", "y" => 36],
                    ["x" => "6.jan", "y" => 33],
                    ["x" => "7.jan", "y" => 34]
                ]
            ],
            "month" => [
                "total bookings" => 123,
                "low booking" => 23,
                "high bookings" => 40,
                "average bookings" => 33,
                "halfdays" => [
                    ["x" => "3.jan", "y" => 20],
                    ["x" => "4.jan", "y" => 22],
                    ["x" => "5.jan", "y" => 21],
                    ["x" => "6.jan", "y" => 25],
                    ["x" => "10.jan", "y" => 26],
                    ["x" => "11.jan", "y" => 20],
                    ["x" => "12.jan", "y" => 20],
                    ["x" => "13.jan", "y" => 20],
                    ["x" => "14.jan", "y" => 22],
                    ["x" => "15.jan", "y" => 21],
                    ["x" => "17.jan", "y" => 25],
                    ["x" => "18.jan", "y" => 26],
                    ["x" => "19.jan", "y" => 22],
                    ["x" => "20.jan", "y" => 21],
                    ["x" => "21.jan", "y" => 25],
                    ["x" => "24.jan", "y" => 26],
                    ["x" => "25.jan", "y" => 22],
                    ["x" => "26.jan", "y" => 21],
                    ["x" => "27.jan", "y" => 25],
                    ["x" => "28.jan", "y" => 26],
                ],
                "wholedays" => [
                    ["x" => "3.jan", "y" => 30],
                    ["x" => "4.jan", "y" => 32],
                    ["x" => "5.jan", "y" => 31],
                    ["x" => "6.jan", "y" => 35],
                    ["x" => "10.jan", "y" => 36],
                    ["x" => "11.jan", "y" => 30],
                    ["x" => "12.jan", "y" => 30],
                    ["x" => "13.jan", "y" => 30],
                    ["x" => "14.jan", "y" => 32],
                    ["x" => "15.jan", "y" => 31],
                    ["x" => "17.jan", "y" => 35],
                    ["x" => "18.jan", "y" => 36],
                    ["x" => "19.jan", "y" => 32],
                    ["x" => "20.jan", "y" => 31],
                    ["x" => "21.jan", "y" => 35],
                    ["x" => "24.jan", "y" => 36],
                    ["x" => "25.jan", "y" => 32],
                    ["x" => "26.jan", "y" => 31],
                    ["x" => "27.jan", "y" => 35],
                    ["x" => "28.jan", "y" => 36],
                ]
            ]

        ];

        $jsonStats = json_encode($jsonStats);
        return view('pages.admin.stats', ['stats' => $jsonStats]);
    }
}
