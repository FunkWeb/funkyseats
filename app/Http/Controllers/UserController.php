<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Checkin;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('pages.admin.profile_page', ['users' => User::all()]);
    }

    public function show(User $user)
    {
        //Using route model binding locks into load() if we want one object with all data
        $userData = $user
            ->load('roles');

        $other_roles = Role::whereDoesntHave('user', function ($q) use ($user) {
            $q
                ->where('id', $user->id);
        })->get();

        //userCheckInStats just gets current month, can be updated to take custom month
        $checkins = Checkin::userCheckinStats($user->id);

        $checkins->total =  intdiv($checkins->total, 60) . ':' . ($checkins->total % 60);
        $checkins->week =  intdiv($checkins->week, 60) . ':' . ($checkins->week % 60);

        return view('pages.admin.user_profile', ['user' => $userData, 'checkins' => $checkins, 'roles' => $other_roles]);
    }

    public function toggleRole(User $user, $role)
    {
        list($type, $message) = $user->toggleRole($role);

        return back()->with($type, $message);
    }

    public function delete(User $user)
    {
        $user->delete();

        return view('pages.admin.profile_page')->with('success', 'You deleted the user successfully');
    }
    public function anonymize(User $user)
    {
        return back()->with('success', 'Functionality not impemented yet');
    }
}
