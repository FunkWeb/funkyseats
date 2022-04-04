<?php

namespace App\Models;

use App\Traits\CanCheckIn;
use \App\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, CanCheckIn;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'social_id',
        'social_type',
        'given_name',
        'family_name',
        'user_thumbnail',
        'anonymized',
        'last_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function  hasActiveBooking(): bool
    {
        $exists = Booking::where('user_id', $this->id)->where('from', '<=', now('Europe/Oslo'))->where('to', '>=', now('Europe/Oslo'))->first();
        return !is_null($exists);
    }

    public function anonymize()
    {
        do {
            $code = random_int(1, 999999);
        } while (User::where("email", "=", 'anonymized@' . $code . '.gone')->first());

        $this->update([
            'name' => 'anonymized',
            'email' => 'anonymized@' . $code . '.gone',
            'given_name' => 'anonymized',
            'family_name' => 'anonymized',
            'user_thumbnail' => 'removed.png',
            'anonymized' => true,
        ]);
    }
}
