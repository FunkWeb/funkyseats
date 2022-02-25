<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('pages.admin.profile_page', ['users' => User::all()]);
    }

    public function show($id)
    {
        return view('pages.admin.user_profile', ['user' => User::find($id)]);
    }
}
