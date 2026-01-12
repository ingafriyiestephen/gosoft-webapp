<?php

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BookingController;
use App\Http\Controllers\API\TripController;
use App\Http\Controllers\API\HireController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\VersionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});


Route::middleware(['logger'])->group(function () {
    Route::get('/', function() {
        return 'welcome to logger middleware implementation';
    });
    
    
    Route::post('payment_callback',  [BookingController::class, 'payment_callback']);
    

    Route::post('/', function(Request $request) {
        // to do something with your request and return the response
        return 'yes it is working as required';
    });
    
});




Route::get('version_code',  [VersionController::class, 'version_code']);
Route::resource('trips', TripController::class);
Route::get('trip_test',  [TripController::class, 'trip_test']);
Route::resource('bookings', BookingController::class);
Route::post('pay_booking', [BookingController::class, 'pay_booking']);
Route::resource('hires', HireController::class);
Route::get('to_array',  [BookingController::class, 'to_array']);
Route::resource('notifications', NotificationController::class);
Route::post('search_trip',  [TripController::class, 'search_trip']);
Route::get('/view_trip/{id}', [TripController::class, 'view_trip']);
Route::resource('users', UserController::class);
Route::post('update_user',  [UserController::class, 'update_user']);
Route::get('locations', [TripController::class, 'locations']);
Route::post('get_otp',  [RegisterController::class, 'get_otp']);
Route::post('verify_otp',  [RegisterController::class, 'verify_otp']);
Route::post('get_email_otp',  [RegisterController::class, 'get_email_otp']);
Route::post('verify_email_otp',  [RegisterController::class, 'verify_email_otp']);
Route::post('verify_register_otp',  [RegisterController::class, 'verify_register_otp']);
Route::post('verify_register_email_otp',  [RegisterController::class, 'verify_register_email_otp']);




