<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LogoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//todo: temporary "home" due to callback using "/" root route
Route::get('/', function () {
    return view('authorized');
});

Route::get('/{name}', function ($name) {
    return view('dynamic', ['name' => $name]);
});
Route::get('/auth/logout', [LogoutController::class, 'perform']);

Route::get('/auth/google', [GoogleController::class, 'googleRedirect']);
Route::get('/callback/google', [GoogleController::class, 'googleCallback']);
