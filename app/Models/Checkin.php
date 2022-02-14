<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'checkeout_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    private function currentStatus()
    {
        return $this->where('user_id', auth()->id())
            ->whereNull('checkout_at')
            ->orderBy('created_at', 'DESC')
            ->first();
    }
}
