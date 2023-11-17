<?php

use App\Models\City;
use App\Models\Termin;
use App\Models\Country;
use App\Models\Location;
use App\Models\Subscriber;
use App\Models\Accommodation;
use App\Models\AccommodationType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\TerminController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\AccommodationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('login', [PageController::class, 'login']);
Route::get('home', [PageController::class, 'home'])->middleware('auth')->name('home');

Route::get('location', [LocationController::class, 'index'])->middleware('auth')->name('location.index');
Route::post('location/country/store', [LocationController::class, 'storeCountry'])->middleware('auth')->name('location.country.store');
Route::post('location/country/delete', [LocationController::class, 'deleteCountry'])->middleware('auth')->name('location.country.delete');
Route::post('location/country/update', [LocationController::class, 'updateCountry'])->middleware('auth')->name('location.country.update');

Route::post('location/store', [LocationController::class, 'storeLocation'])->middleware('auth')->name('location.store');
Route::post('location/delete', [LocationController::class, 'deleteLocation'])->middleware('auth')->name('location.delete');
Route::get('location/edit/{id}', [LocationController::class, 'editLocation'])->middleware('auth')->name('location.edit');
Route::post('location/update/{id}', [LocationController::class, 'updateLocation'])->middleware('auth')->name('location.update');

Route::get('accommodation', [AccommodationController::class, 'index'])->middleware('auth')->name('accommodation.index');
Route::get('accommodation/show/{id}', [AccommodationController::class, 'show'])->middleware('auth')->name('accommodation.show');
Route::get('accommodation/edit/{id}', [AccommodationController::class, 'edit'])->middleware('auth')->name('accommodation.edit');
Route::get('accommodation/add', [AccommodationController::class, 'add'])->middleware('auth')->name('accommodation.add');
Route::post('accommodation/store', [AccommodationController::class, 'store'])->middleware('auth')->name('accommodation.store');
Route::post('accommodation/update/{id}', [AccommodationController::class, 'update'])->middleware('auth')->name('accommodation.update');
Route::post('accommodation/delete/{id}', [AccommodationController::class, 'delete'])->middleware('auth')->name('accommodation.delete');
Route::post('accommodation/offer/add', [AccommodationController::class, 'offerAdd'])->middleware('auth')->name('accommodation.offer.add');
Route::post('accommodation/offer/remove', [AccommodationController::class, 'offerRemove'])->middleware('auth')->name('accommodation.offer.remove');

Route::get('termin/add/{id}', [TerminController::class, 'add'])->middleware('auth')->name('termin.add');
Route::get('termin/generate/{id}', [TerminController::class, 'generate'])->middleware('auth')->name('termin.generate');
Route::post('termin/reserve/{id}', [TerminController::class, 'reserve'])->middleware('auth')->name('termin.reserve');
Route::post('termin/store/{id}', [TerminController::class, 'store'])->middleware('auth')->name('termin.store');
Route::post('termin/update/{id}', [TerminController::class, 'update'])->middleware('auth')->name('termin.update');
Route::post('termin/delete/{id}', [TerminController::class, 'delete'])->middleware('auth')->name('termin.delete');

Route::get('users', [UserController::class, 'index'])->middleware('auth', 'admin')->name('users');
Route::get('users/add', [UserController::class, 'add'])->middleware('auth', 'admin')->name('users.add');
Route::post('users/store', [UserController::class, 'store'])->middleware('auth', 'admin')->name('users.store');
Route::post('users/delete', [UserController::class, 'delete'])->middleware('auth', 'admin')->name('users.delete');
Route::get('users/info/{id}', [UserController::class, 'info'])->middleware('auth', 'admin')->name('users.info');
Route::get('users/password', [UserController::class, 'password'])->middleware('auth', 'admin')->name('users.password');
Route::post('users/password/change', [UserController::class, 'passwordChange'])->middleware('auth', 'admin')->name('users.password.change');

Route::get('testimonail/index', [TestimonialController::class, 'index'])->middleware('auth')->name('testimonial.index');
Route::get('testimonail/add', [TestimonialController::class, 'add'])->middleware('auth')->name('testimonial.add');
Route::post('testimonail/store', [TestimonialController::class, 'store'])->middleware('auth')->name('testimonial.store');
Route::post('testimonail/delete/{id}', [TestimonialController::class, 'delete'])->middleware('auth')->name('testimonial.delete');

Route::get('subscribers/show', [SubscriberController::class, 'show'])->middleware('auth')->name('subscribers.show');
Route::post('subscribers/delete', [SubscriberController::class, 'delete'])->middleware('auth')->name('subscribers.delete');

Route::get('tickets/index', [TicketController::class, 'index'])->middleware('auth')->name('tickets.index');
Route::get('tickets/confirm/{id}', [TicketController::class, 'confirm'])->middleware('auth')->name('tickets.confirm');

Route::get('offers/index', [OfferController::class, 'index'])->middleware('auth')->name('offers.index');
Route::get('offers/add', [OfferController::class, 'add'])->middleware('auth')->name('offers.add');
Route::post('offers/store', [OfferController::class, 'store'])->middleware('auth')->name('offers.store');


Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');


