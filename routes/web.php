<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\UserController;

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

Route::group(['middleware' => 'role:admin'], function () {
    //Room admin routes
    Route::get('/rooms/edit', [RoomController::class, 'edit'])->name('room.edit');
    Route::post('/rooms/{id}/save', [RoomController::class, 'save'])->name('room.update');
    Route::post('/rooms/{id}/delete', [RoomController::class, 'delete'])->name('room.destroy');
    Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');

    //Seat admin routes
    Route::get('/room/{id}/seats/edit', [SeatController::class, 'edit'])->name('seat.edit');
    Route::post('/seats/{id}/save', [SeatController::class, 'save'])->name('seat.update');
    Route::post('/seats/{id}/delete', [SeatController::class, 'delete'])->name('seat.destroy');
    Route::post('/seat/store', [SeatController::class, 'store'])->name('seat.store');
});

//Login routes
Route::get('/auth/logout', [LogoutController::class, 'perform'])->name('logout');
Route::get('/auth/google', [GoogleController::class, 'googleRedirect'])->name('login');
Route::get('/callback/google', [GoogleController::class, 'googleCallback'])->name('google.callback');


Route::group(['middleware' => 'auth'], function () {
    //Booking routes
    Route::post('/booking/seat/{seat_id}', [BookingController::class, 'store'])->name('booking.store');
    Route::post('/booking/seat/random/{room_id}', [BookingController::class, 'randomSeat'])->name('booking.random');
    Route::get('/booking/delete/{booking_id}', [BookingController::class, 'delete'])->name('booking.destroy');
});

Route::get('/', [RoomController::class, 'index_withCountSeats'])->name('home');
Route::get('/display/{id}', [RoomController::class, 'show_display'])->name('display.show');
Route::get('/room/{id}/{datetime?}', [RoomController::class, 'show'])->name('room.show');

//TODO:(are) Add middleware for IP check!
Route::get('/checkin', [CheckinController::class, 'togglestatus'])->name('checkin')->middleware(['auth', 'checkin']);
Route::get('/profiles', [UserController::class, 'index']);

Route::get('/roles', function () {
    return View('pages.admin.role_assignment');
})->name('roles');
