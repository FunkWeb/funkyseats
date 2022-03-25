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
        $result = checkin::currentStatus();
        if (!$result) {
            return false;
        } elseif ($result->checkout_at != null) {
            return false;
        } else {
            return true;
        }
    }

    public function toggleStatus(): string
    {
        $latest_checkin = Checkin::currentStatus();
        if (!$latest_checkin) {
            $this->checkins()->create();
            return "Checked in";
        } elseif ($latest_checkin->created_at >= now()->addMinutes(-5)) {
            $latest_checkin->delete();
            return "Checkin too short, removed entry";
        } elseif ($latest_checkin->checkout_at == null) {
            $latest_checkin->checkout_at = now();
            $latest_checkin->save();
            return "Checked out";
        } elseif ($latest_checkin->checkout_at >= now()->addMinutes(-5)) {
            $latest_checkin->checkout_at = null;
            $latest_checkin->save();
            return "Resumed earlier checkin";
        } else {
            $this->checkins()->create();
            return "Checked in";
        }
    }
}
