<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SeatController;
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

Route::group(['middleware' => 'role:admin'], function () {
    //Room admin routes
    Route::get('/rooms/edit', [RoomController::class, 'edit']);
    Route::post('/rooms/{id}/save', [RoomController::class, 'save']);
    Route::post('/rooms/{id}/delete', [RoomController::class, 'delete']);
    Route::post('/room/store', [RoomController::class, 'store']);

    //Seat admin routes
    Route::get('/room/{id}/seats/edit', [SeatController::class, 'edit']);
    Route::post('/seats/{id}/save', [SeatController::class, 'save']);
    Route::post('/seats/{id}/delete', [SeatController::class, 'delete']);
    Route::post('/seat/store', [SeatController::class, 'store']);
});

//Login routes
Route::get('/auth/logout', [LogoutController::class, 'perform']);
Route::get('/auth/google', [GoogleController::class, 'googleRedirect'])->name('login');
Route::get('/callback/google', [GoogleController::class, 'googleCallback']);


Route::group(['middleware' => 'auth'], function () {
    //Booking routes
    Route::post('/booking/seat/{seat_id}', [BookingController::class, 'store']);
    Route::post('/booking/seat/random/{room_id}', [BookingController::class, 'randomSeat']);
    Route::get('/booking/delete/{booking_id}', [BookingController::class, 'delete'])->name('deleteBooking');
});

Route::get('/', [RoomController::class, 'index_withCountSeats'])->name('home');
Route::get('/display/{id}', [RoomController::class, 'show_display']);
Route::get('/room/{id}/{datetime?}', [RoomController::class, 'show']);

Route::get('/admin', function () {
    return View('pages/admin/confirmation');
});
Route::get('/faq', [FaqController::class, 'index']);
