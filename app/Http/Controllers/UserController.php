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

    public function show($id)
    {
        $user = User::where('id', $id)
            ->with(["checkin" => function ($query) {
                $query->select(
                    DB::raw('SUM(TIMESTAMPDIFF(MINUTE,created_at,checkout_at)) as total'),
                    // DB::raw('SUM(case when YEARWEEK(`created_at`, 1) = YEARWEEK(CURDATE(), 1) 
                    //  then TIMESTAMPDIFF(MINUTE,created_at,checkout_at) 
                    //  else 0 end) as week'),
                    // DB::raw('SUM(forced_checkout) as forced'),
                    // DB::raw('SUM(case when WEEKDAY(created_at)=0 then 1 else 0 end) as Monday'),
                    // DB::raw('SUM(case when WEEKDAY(created_at)=1 then 1 else 0 end) as Tuesday'),
                    // DB::raw('SUM(case when WEEKDAY(created_at)=2 then 1 else 0 end) as Wednesday'),
                    // DB::raw('SUM(case when WEEKDAY(created_at)=3 then 1 else 0 end) as Thursday'),
                    // DB::raw('SUM(case when WEEKDAY(created_at)=4 then 1 else 0 end) as Friday')
                );
            }])
            ->with('role')->get();

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
        )->get();

        return view('pages.admin.user_profile', ['user' => $user, 'checkins' => $checkins, 'roles' => Role::all()]);
    }
}
