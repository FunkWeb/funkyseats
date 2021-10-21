<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\HasRole;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\BookingController;

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

Route::get('/', [RoomController::class, 'index_withCountSeats']);

Route::get('/room/{id}', [RoomController::class, 'show']);

Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/admin', function () {
        return View('admin');
    })->name('admin');
});
Route::get('/auth/logout', [LogoutController::class, 'perform']);

Route::get('/auth/google', [GoogleController::class, 'googleRedirect'])->name('login');
Route::get('/callback/google', [GoogleController::class, 'googleCallback']);

Route::post('/booking/seat/{seat_id}', [BookingController::class, 'store']);
