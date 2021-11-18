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
        dd($user->user["family_name"]);

        $searchUser = User::where('social_id', $user->id)->first();

        if ($searchUser) {
            if ($user->getAvatar() != $searchUser->user_thumbnail) {
                $searchUser->user_thumbnail = $user->getAvatar();
                $searchUser->save();
            }
            Auth::login($searchUser);
        } else {
            $googleUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'social_id' => $user->id,
                'social_type' => 'google',
                'given_name' => $user->user["given_name"],
                'family_name' => $user->user["family_name"],
                'password' => encrypt('my_google'),
                'user_thumbnail' => $user->getAvatar(),
            ]);
            Auth::login($googleUser);
        }
        return redirect($redirectAdress);
    }
}
