<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Checkin;
use App\Models\User;
use Carbon\Carbon;

class CheckinController extends Controller
{
    public function toggleStatus()
    {
        return back()->with('checkinStatus', Auth::user()->toggleStatus());
    }

    public function downloadCheckinData(User $user)
    {
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=stats-' . $user->name . '-' . now('Europe/Oslo') . '.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $data = Checkin::select('created_at', 'checkout_at', 'forced_checkout')->where('user_id', $user->id)->get()->toArray();
        array_unshift($data, array_keys($data[0]));

        foreach ($data as $key => $value) {
            if ($key == 0) {
                array_push($data[$key], 'Time checked in');
                continue;
            }
            $minutes = Carbon::createFromTimeString($value['created_at'])->diffInMinutes(Carbon::parse($value['checkout_at']));
            $timestring = intdiv($minutes, 60) . ':' . ($minutes % 60);
            array_push($data[$key], $timestring);
        }

        $formatdata = function () use ($data) {
            $FH = fopen('php://output', 'w');
            foreach ($data as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };

        return response()->stream($formatdata, 200, $headers);
    }
}
