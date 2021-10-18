<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback()
    {
        //TODO: make the real login work
        $user = Socialite::driver('google')->user();

        $searchUser = User::where('google_id', $user->id)->first();

        if ($searchUser) {

            Auth::login($searchUser);

            return redirect('/dashboard');
        } else {
            $googleUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'auth_type' => 'google',
                'password' => encrypt('gitpwd059')
            ]);

            Auth::login($googleUser);

            return redirect('/dashboard');
        }
    }
}
