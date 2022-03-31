<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Booking' => 'App\Policies\BookingPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('checkin-ip', function () {
            $canCheckin = (\Request::ip() == config('checkin.checkin_ip') || \Request::ip() ==  '127.0.0.1') && auth()->user()->hasActiveBooking();
            return $canCheckin;
        });
    }
}
