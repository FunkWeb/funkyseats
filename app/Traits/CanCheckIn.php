<?php

namespace App\Traits;

use App\Models\Checkin;

trait CanCheckIn
{
    public function checkins()
    {
        return $this->hasMany(Checkin::class);
    }

    public function getCheckedInAttribute(): bool
    {
        return (bool)Checkin::currentStatus();
    }

    public function toggleStatus(): string
    {
        $row = Checkin::currentStatus();
        if (!$row) {
            $new_checkin = new Checkin;
            $new_checkin->user_id = auth()->user()->id;
            $new_checkin->save();
            return "Checked in";
        } elseif ($row->created_at >= now()->addMinutes(-5)) {
            $row->delete();
            return "Checkin to short, removed entry";
        } elseif ($row->checkout_at == null) {
            $row->checkout_at = now();
            $row->save();
            return "Checked out";
        } elseif ($row->checkout_at >= now()->addMinutes(-5)) {
            $row->checkout_at = null;
            $row->save();
            return "Resumed earlier checkin";
        } else {
            $new_checkin = new Checkin;
            $new_checkin->user_id = auth()->user()->id;
            $new_checkin->save();
            return "Checked in";
        }
    }
}
