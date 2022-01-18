<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class seat_component extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $seat;
    public $user;
    public function __construct($seat, $user)
    {
        $this->user = $user;
        $this->seat = $seat;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.seat_component');
    }
}
