<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\TerminController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SubscriberController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/current/offer', [ApiController::class, 'currentOffer']);
Route::get('countries', [ApiController::class, 'countries']);
Route::get('/testimonials', [ApiController::class, 'testimonials']);
Route::get('/accommodation/details', [ApiController::class, 'accommodationDetails']);
Route::get('/accommodations/country', [ApiController::class, 'accommodationsByCountry']);
Route::get('/accommodations/region', [ApiController::class, 'accommodationsByRegion']);

Route::post('/ticket/request', [TicketController::class, 'store']);
Route::post('/add/subscriber', [SubscriberController::class, 'add']);

// Admin Panel Routes
Route::post('/get/locations', [OfferController::class, 'locations']);
Route::post('/image/delete', [ImageController::class, 'delete']);
Route::post('/edit/note', [TerminController::class, 'editNote']);




