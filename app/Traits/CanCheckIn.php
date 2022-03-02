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
        $row = Checkin::currentStatus();
        if (!$row) {
            $this->checkins()->create();
            return "Checked in";
        } elseif ($row->created_at >= now()->addMinutes(-5)) {
            $row->delete();
            return "Checkin too short, removed entry";
        } elseif ($row->checkout_at == null) {
            $row->checkout_at = now();
            $row->save();
            return "Checked out";
        } elseif ($row->checkout_at >= now()->addMinutes(-5)) {
            $row->checkout_at = null;
            $row->save();
            return "Resumed earlier checkin";
        } else {
            $this->checkins()->create();
            return "Checked in";
        }
    }
}
