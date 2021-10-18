<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function googleRedirect()
    {
        Session::put('redirect', url()->previous());
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback()
    {
        $redirectAdress = Session::get('redirect') ?? "/";
        Session::forget('redirect');
        $user = Socialite::driver('google')->user();

        $searchUser = User::where('social_id', $user->id)->first();

        if ($searchUser) {

            Auth::login($searchUser);
            return redirect($redirectAdress);
        } else {
            $googleUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'social_id' => $user->id,
                'social_type' => 'google',
                'password' => encrypt('my_google')
            ]);
            Auth::login($googleUser);

            return redirect($redirectAdress);
        }
    }
}
