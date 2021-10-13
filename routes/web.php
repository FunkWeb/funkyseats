<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SeatController;
use App\Http\Middleware\HasRole;

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

Route::get('/', [RoomController::class, 'index']);

Route::get('/rooms', [RoomController::class, 'index_withCountSeats']);

Route::get('/room/{id}', [RoomController::class, 'show']);
Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/admin', function () {
        return View('admin');
    })->name('admin');
});
