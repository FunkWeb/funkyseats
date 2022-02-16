<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckinController extends Controller
{
    public function toggleStatus()
    {
        return back()->with('success', Auth::user()->toggleStatus());
    }
}
