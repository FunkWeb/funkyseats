<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Checkin extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'checkeout_at' => 'datetime',
    ];
    protected $attributes = [
        'forced_checkout' => false,
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function currentStatus()
    {
        return Checkin::where('user_id', auth()->id())
            ->orderBy('created_at', 'DESC')
            ->first();
    }

    public static function userCheckinStats($user_id, $month = null)
    {
        if (!$month) {
            $month = date('m');
        }
        return Checkin::select(
            DB::raw('SUM(TIMESTAMPDIFF(MINUTE,created_at,checkout_at)) as total'),
            DB::raw('SUM(case when YEARWEEK(`created_at`, 1) = YEARWEEK(CURDATE(), 1) 
              then TIMESTAMPDIFF(MINUTE,created_at,checkout_at) 
              else 0 end) as week'),
            DB::raw('SUM(forced_checkout) as forced'),
            DB::raw('SUM(case when WEEKDAY(created_at)=0 then 1 else 0 end) as Monday'),
            DB::raw('SUM(case when WEEKDAY(created_at)=1 then 1 else 0 end) as Tuesday'),
            DB::raw('SUM(case when WEEKDAY(created_at)=2 then 1 else 0 end) as Wednesday'),
            DB::raw('SUM(case when WEEKDAY(created_at)=3 then 1 else 0 end) as Thursday'),
            DB::raw('SUM(case when WEEKDAY(created_at)=4 then 1 else 0 end) as Friday')
        )
            ->where('user_id', $user_id)
            ->whereMonth('created_at', $month)
            ->get()
            ->first();
    }
}
