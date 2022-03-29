<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    use HasFactory;



    public function seat()
    {
        return $this->BelongsTo(Seat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function bookingStats($month)
    {
        return Booking::select(
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
            ->whereRaw("MONTH(STR_TO_DATE(`from`, '%Y-%m-%d %H:%i:%s')) = ?", [$month]);
    }
}
