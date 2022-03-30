<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use \Carbon\Carbon;

class BookingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Booking $booking)
    {
        if ($user->id == $booking->user_id && Carbon::createFromDate($booking->from)->startOfDay() >= now()->startOfDay()) {
            return true;
        } elseif ($user->hasRole('admin')) {
            return true;
        } else {
            return false;
        }
    }
}
