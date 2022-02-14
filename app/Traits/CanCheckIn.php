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
        return (bool)$this->checkins()->currentStatus();
    }

    public function toggleStatus(): bool
    {
        if ($row = $this->checkins()->currentStatus()) {
            $row->update(['checked_out' => now()]);
            return false;
        }

        $this->checkins()->create();
        return true;
    }

}
