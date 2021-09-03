<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TransportationBookingController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
// Users
Route::get('/transportation', [TransportationBookingController::class, 'bookingList'])->name('transportation_booking');
Route::get('/transportation/add', [TransportationBookingController::class, 'bookingForm'])->name('addtransportationBooking');
Route::post('/transportation/add', [TransportationBookingController::class, 'bookingForm'])->name('addtransportationBooking');
Route::get('/transportation/edit', [TransportationBookingController::class, 'bookingForm'])->name('edittransportationBooking');
Route::post('/transportation/edit', [TransportationBookingController::class, 'bookingForm'])->name('edittransportationBooking');
Route::post('/transportation/remove', [TransportationBookingController::class, 'cancel'])->name('canceltransportationBooking');
Route::get('/transportation/view', [TransportationBookingController::class, 'viewBooking'])->name('ViewTripBooking');


Route::get('/trips/search/pickup', [TripController::class, 'getPickappLocations'])->name('search_pickup');
Route::get('/trips/search/destination', [TripController::class, 'getDestinations'])->name('searh_destination');

Route::get('/trips/vehicles', [TripController::class, 'getVehicle'])->name('getVehicle');
Route::post('/trips/total', [TripController::class, 'calculateTotal'])->name('calculateTripTotal');

Route::get('/user/balance', [UserController::class, 'index'])->name('user_balance');

Route::get('/setting', [SettingController::class, 'index'])->name('setting');
Route::post('/setting', [SettingController::class, 'index'])->name('setting');



