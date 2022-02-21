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
}
