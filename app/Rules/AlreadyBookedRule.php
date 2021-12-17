<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Booking;
use Carbon\Carbon;

class AlreadyBookedRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($from, $to)
    {
        //
        $this->from = Carbon::create($from);
        $this->to = Carbon::create($to);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $bookedSeats = Booking::where('user_id', $value)
            ->where(function ($query) {
                $query->where('from', '=', $this->from)
                    ->orWhere('to', '=', $this->to);
            })
            ->get();
        if (!$bookedSeats->first()) {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You already have a seat booked right now';
    }
}
