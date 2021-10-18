<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function googleRedirect(Request $request)
    {
        Session::put('redirect', $request->input('redirectTo'));
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
            //TODO: make these redirect somewhere else after services callback is fixed
            return redirect($redirectAdress);
        } else {
            $googleUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'social_id' => $user->id,
                'social_type' => 'google',
                'password' => encrypt('my_google')
            ]);

            //TODO: make these redirect somewhere else after services callback is fixed
            Auth::login($googleUser);

            return redirect($redirectAdress);
        }
    }
}
