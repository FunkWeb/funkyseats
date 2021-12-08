<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;
use App\Models\Booking;

class SeatAlreadyTakenRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct($from, $to)
    {
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
            ->where('from', '=', $this->from)
            ->orWhere('to', '=', $this->to)
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
        return 'The seat you tried to book is taken by somebody else';
    }
}
