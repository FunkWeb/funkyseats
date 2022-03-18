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
            return "Sjekket inn";
        } elseif ($latest_checkin->created_at >= now()->addMinutes(-5)) {
            $latest_checkin->delete();
            return "Insjekkingen var for kort, den blir ikke logget";
        } elseif ($latest_checkin->checkout_at == null) {
            $latest_checkin->checkout_at = now();
            $latest_checkin->save();
            return "Sjekket ut";
        } elseif ($latest_checkin->checkout_at >= now()->addMinutes(-5)) {
            $latest_checkin->checkout_at = null;
            $latest_checkin->save();
            return "Fortsetter tidligere insjekking";
        } else {
            $this->checkins()->create();
            return "Sjekket inn";
        }
    }
}
