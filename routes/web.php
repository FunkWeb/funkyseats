<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\SeatTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FaqController;


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

Route::group(['middleware' => 'last.active'], function () {
    Route::group(['middleware' => 'role:admin'], function () {
        //Room admin routes
        Route::get('/rooms/edit', [RoomController::class, 'edit'])->name('room.edit');
        Route::post('/rooms/{room}/save', [RoomController::class, 'update'])->name('room.update');
        Route::post('/rooms/{room}/delete', [RoomController::class, 'delete'])->name('room.destroy');
        Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');

        //Seat admin routes
        Route::get('/room/{id}/seats/edit', [SeatController::class, 'edit'])->name('seat.edit');
        Route::post('/seats/{seat}/save', [SeatController::class, 'update'])->name('seat.update');
        Route::post('/seats/{seat}/delete', [SeatController::class, 'delete'])->name('seat.destroy');
        Route::post('/seat/store', [SeatController::class, 'store'])->name('seat.store');

        Route::get('/admin/edit_seat_types', [SeatTypeController::class, 'edit'])->name('seatType.edit');
        Route::post('/admin/edit_seat_types/edit/{seatType}', [SeatTypeController::class, 'update'])->name('seatType.update');
        Route::post('/admin/edit_seat_types/delete/{id}', [SeatTypeController::class, 'destroy'])->name('seatType.destroy');
        Route::post('/admin/edit_seat_types/store', [SeatTypeController::class, 'store'])->name('seatType.store');

        Route::get('/profiles', [UserController::class, 'index'])->name('user.index');
        Route::get('/profile/{user}/toggle/{role}', [UserController::class, 'toggleRole'])->name('user.toggleRole');
        Route::get('/profile/{user}/delete', [UserController::class, 'delete'])->name('user.delete');
        Route::get('/profile/{user}/anonymize', [UserController::class, 'anonymize'])->name('user.anonymize');

        Route::get('/admin/stats/{id?}', [StatisticsController::class, 'seatBookingStatistics'])->name('statistics.bookings');
    });

    //Login routes
    Route::get('/auth/logout', [LogoutController::class, 'perform'])->name('logout');
    Route::get('/auth/google', [GoogleController::class, 'googleRedirect'])->name('login');
    Route::get('/callback/google', [GoogleController::class, 'googleCallback'])->name('google.callback');


    Route::group(['middleware' => 'auth'], function () {
        //Booking routes
        Route::post('/booking/seat/{seat_id}', [BookingController::class, 'store'])->name('booking.store');
        Route::post('/booking/seat/random/{room_id}', [BookingController::class, 'randomSeat'])->name('booking.random');
        Route::get('/booking/delete/{booking}', [BookingController::class, 'delete'])->name('booking.destroy');
    });

    Route::get('/', [RoomController::class, 'index_withCountSeats'])->name('home');
    Route::get('/display/{id}', [RoomController::class, 'show_display'])->middleware('officeoradmin')->name('display.show');
    Route::get('/room/{id}/{datetime?}', [RoomController::class, 'show'])->name('room.show');

    Route::get('/checkin', [CheckinController::class, 'togglestatus'])->name('checkin')->middleware(['auth', 'checkin']);

    Route::get('/profile/{user}', [UserController::class, 'show'])->middleware(['middleware' => 'owner.or.admin:admin']);

    Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

    Route::get('/mybookings', [BookingController::class, 'index'])->name('booking.mybookings');

    Route::get('/admin', function () {
        return View('pages/admin/confirmation');
    });


    Route::get('/user_profile', function () {
        return View('pages/admin/user_profile');
    });
});
