<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\HireController;
use App\Http\Controllers\ParcelTypeController;
use App\Http\Controllers\WelcomeSMSController;

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

// Route::get('/', function () {
//     return view('/home/index');
// });

// Route::get('/', function () {
//     return view('home.index');
// })->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Route::get('/',  [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/', [AdminController::class, 'booking_dashboard'])->name('booking_dashboard');
    //Search Trip
    Route::post('/search_trip', [HomeController::class, 'search_trip']);
    Route::get('/view_trip/{id}', [HomeController::class, 'view_trip']);
    Route::get('/view_seats', [HomeController::class, 'view_seats']);
    //Booking Route
    Route::post('/store_booking', [BookingController::class, 'store_booking']);
    Route::post('/pay_booking', [BookingController::class, 'pay_booking']);
    Route::get('/booking_dashboard', [AdminController::class, 'booking_dashboard'])->name('booking_dashboard');
    Route::get('/home_parcels',  [HomeController::class, 'home_parcels'])->name('home_parcels');
    // Route::get('/home', [HomeController::class, 'view_trips'])->('dasghboard');
    Route::get('/admin_bookings', [AdminController::class, 'admin_bookings']);

    Route::get('/edit_admin_booking/{id}', [AdminController::class, 'edit_admin_booking']);
    Route::post('/update_admin_booking/{id}', [AdminController::class, 'update_admin_booking']);
    Route::delete('/delete_admin_booking/{id}', [AdminController::class, 'delete_admin_booking']);

    //The code below has been commentented out for now
    //Route::get('/admin', [AdminController::class, 'dashboard']);
    //Route::get('/admin', [ParcelController::class, 'parcel_dashboard']);

    //Location Route
    Route::get('/locations', [AdminController::class, 'locations']);
    Route::post('/store_location', [AdminController::class, 'store_location']);
    Route::get('/edit_location/{id}', [AdminController::class, 'edit_location']);
    Route::post('/update_location/{id}', [AdminController::class, 'update_location']);
    Route::delete('/delete_location/{id}', [AdminController::class, 'delete_location']);

    //Bus Route
    Route::get('/buses', [AdminController::class, 'buses']);
    Route::post('/store_bus', [AdminController::class, 'store_bus']);
    Route::get('/edit_bus/{id}', [AdminController::class, 'edit_bus']);
    Route::post('/update_bus/{id}', [AdminController::class, 'update_bus']);
    Route::delete('/delete_bus/{id}', [AdminController::class, 'delete_bus']);

    //Driver's Route
    Route::get('/drivers', [AdminController::class, 'drivers']);
    Route::post('/store_driver', [AdminController::class, 'store_driver']);
    Route::get('/edit_driver/{id}', [AdminController::class, 'edit_driver']);
    Route::post('/update_driver/{id}', [AdminController::class, 'update_driver']);
    Route::delete('/delete_driver/{id}', [AdminController::class, 'delete_driver']);

    //Trip Route
    Route::get('/trips', [TripController::class, 'trips']);
    Route::post('/store_trip', [TripController::class, 'store_trip']);
    Route::get('/edit_trip/{id}', [TripController::class, 'edit_trip']);
    Route::post('/update_trip/{id}', [TripController::class, 'update_trip']);
    Route::delete('/delete_trip/{id}', [TripController::class, 'delete_trip']);
    Route::post('/search_booking_user', [AdminController::class, 'search_booking_user']);
    Route::post('/store_user_booking', [BookingController::class, 'store_user_booking']);

    Route::post('/pay_booking', [BookingController::class, 'pay_booking']);
    Route::get('/my_bookings', [BookingController::class, 'my_bookings'])->name('my_bookings');;


    //Search Trip
    Route::post('/search_parcel', [HomeController::class, 'search_parcel']);

    //Booking Route
    Route::get('/create_trip_booking/{id}', [AdminController::class, 'create_trip_booking']);
    Route::post('/store_trip_booking/{id}', [AdminController::class, 'store_trip_booking']);
    Route::get('/show_trip_bookings/{id}', [AdminController::class, 'show_trip_bookings']);
    Route::get('select_seat/{id}', [BookingController::class, 'select_seat']);
    Route::post('/update_seat/{id}', [BookingController::class, 'update_seat']);
    Route::post('/confirm_booking/{id}', [BookingController::class, 'confirm_booking']);

    //Team Route
    Route::get('/team_members', [UserController::class, 'team_members']);
    Route::post('/store_member', [UserController::class, 'store_member']);
    Route::get('/edit_member/{id}', [UserController::class, 'edit_member']);
    Route::post('/update_member/{id}', [UserController::class, 'update_member']);
    Route::delete('/delete_member/{id}', [UserController::class, 'delete_member']);

    //Customers Route
    Route::get('/customers', [BookingController::class, 'customers']);


    //Parcel Route
    Route::get('/parcels', [ParcelController::class, 'parcels']);
    Route::get('/create_parcel', [ParcelController::class, 'create_parcel']);
    Route::post('/parcel_user_search', [AdminController::class, 'parcel_user_search']);
    Route::post('/store_parcel', [ParcelController::class, 'store_parcel']);
    Route::get('/edit_parcel/{id}', [ParcelController::class, 'edit_parcel']);
    Route::post('/update_parcel/{id}', [ParcelController::class, 'update_parcel']);
    Route::delete('/delete_parcel/{id}', [ParcelController::class, 'delete_parcel']);
    Route::get('/parcel_dashboard', [ParcelController::class, 'parcel_dashboard']);
    Route::get('/parcel_types', [ParcelController::class, 'parcel_types']);
    Route::post('/store_parcel_type', [ParcelController::class, 'store_parcel_type']);
    Route::delete('/delete_ptype/{id}', [ParcelController::class, 'delete_ptype']);
    //Sign Parcel
    Route::get('/sign_parcel/{id}', [ParcelController::class, 'sign_parcel']);
    Route::post('/sign_store/{id}', [ParcelController::class, 'sign_store']);


    Route::get('/parcel_received_sms', [ParcelController::class, 'parcel_received_sms']);

    Route::get('/ajax_locations', [HomeController::class, 'ajax_locations']);
    Route::post('/send_ajax', [HomeController::class, 'send_ajax']);

    Route::resource('places', AjaxController::class);

    Route::resource('hires', HireController::class);

    Route::resource('parcel_types', ParcelTypeController::class);

    // Route::resource('notifications', NotificationController::class);
    // Route::get('/edit_notification/{id}', [NotificationController::class, 'edit_notification']);
    // Route::post('/update_notification/{id}', [NotificationController::class, 'update_notification']);
    // Route::delete('/delete_notification/{id}', [NotificationController::class, 'delete_notification']);
    // Route::post('/store_notification', [NotificationController::class, 'store_notification']);
});

//Phone Login
Route::post('/auth/register_otp', [UserController::class, 'register_otp']);
Route::post('/auth/verify_register_otp', [UserController::class, 'verify_register_otp']);
Route::post('/auth/get_otp', [UserController::class, 'get_otp']);
Route::post('/auth/verify_otp', [UserController::class, 'verify_otp']);

//View QR Code
// Route::get('/parcel_qrcode/{id}', [QrcodeController::class, 'parcel_qrcode']);

//Parcel Payment Receipt
Route::get('/parcel_receipt/{id}', [ReceiptController::class, 'parcel_receipt']);

//Product Payment Receipt
Route::get('/product_receipt/{id}', [ReceiptController::class, 'product_receipt']);

//Terms
Route::get('/terms', [HomeController::class, 'terms']);
Route::get('/privacy_policy', [HomeController::class, 'privacy_policy']);
