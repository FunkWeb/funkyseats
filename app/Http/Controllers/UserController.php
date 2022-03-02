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
            //->checkins()->select(DB::raw('SUM(TIMESTAMPDIFF(MINUTE,created_at,checkout_at)) as total'),
            // DB::raw('SUM(case when YEARWEEK(`created_at`, 1) = YEARWEEK(CURDATE(), 1) 
            //   then TIMESTAMPDIFF(MINUTE,created_at,checkout_at) 
            //   else 0 end) as week'),
            // DB::raw('SUM(forced_checkout) as forced'),
            // DB::raw('SUM(case when WEEKDAY(created_at)=0 then 1 else 0 end) as Monday'),
            // DB::raw('SUM(case when WEEKDAY(created_at)=1 then 1 else 0 end) as Tuesday'),
            // DB::raw('SUM(case when WEEKDAY(created_at)=2 then 1 else 0 end) as Wednesday'),
            // DB::raw('SUM(case when WEEKDAY(created_at)=3 then 1 else 0 end) as Thursday'),
            // DB::raw('SUM(case when WEEKDAY(created_at)=4 then 1 else 0 end) as Friday'))
            ->load('roles'); // or ->roles() <- this gives no user model data only the roles
        //->load('checkins');


        //Wheremonth can be changed later if they want spesific month
        $checkins = Checkin::select(
            DB::raw('SUM(TIMESTAMPDIFF(MINUTE,created_at,checkout_at)) as total'),
            DB::raw('SUM(case when YEARWEEK(`created_at`, 1) = YEARWEEK(CURDATE(), 1) 
              then TIMESTAMPDIFF(MINUTE,created_at,checkout_at) 
              else 0 end) as week'),
            DB::raw('SUM(forced_checkout) as forced'),
            DB::raw('SUM(case when WEEKDAY(created_at)=0 then 1 else 0 end) as Monday'),
            DB::raw('SUM(case when WEEKDAY(created_at)=1 then 1 else 0 end) as Tuesday'),
            DB::raw('SUM(case when WEEKDAY(created_at)=2 then 1 else 0 end) as Wednesday'),
            DB::raw('SUM(case when WEEKDAY(created_at)=3 then 1 else 0 end) as Thursday'),
            DB::raw('SUM(case when WEEKDAY(created_at)=4 then 1 else 0 end) as Friday')
        )->where('user_id', $user->id)->whereMonth('created_at', date('m'))->get()->first();

        $checkins->total =  intdiv($checkins->total, 60) . ':' . ($checkins->total % 60);
        $checkins->week =  intdiv($checkins->week, 60) . ':' . ($checkins->week % 60);

        return view('pages.admin.user_profile', ['user' => $userData, 'checkins' => $checkins, 'roles' => Role::all()]);
    }

    public function toggleRole(User $user, $role)
    {

        if ($user->hasRole($role)) {
            $user->removeRole($role);
        } else {
            $user->assignRole($role);
        }

        return back()->with('success', 'Role status updated');
    }

    public function delete(User $user)
    {
        $user->delete();

        return back()->with('success', 'You deleted the user successfully');
    }
    public function anonymize(User $user)
    {
        return view('pages.admin.profile_page')->with('success', 'Functionality not impemented yet');
    }
}
