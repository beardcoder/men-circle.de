<?php

use App\Http\Controllers\Frontend\SubscriptionController;
use App\Http\Controllers\Frontend\AppointmentController;
use App\Http\Controllers\Frontend\PageDisplayController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;
use Spatie\ResponseCache\Middlewares\DoNotCacheResponse;

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

Route::get('/', [PageDisplayController::class, 'home'])->name('frontend.home');

Route::get('{slug}', [PageDisplayController::class, 'show'])->name('frontend.page');

Route::post('subscription/signup', [SubscriptionController::class, 'signup'])
  ->middleware(ProtectAgainstSpam::class)
  ->middleware(DoNotCacheResponse::class)
  ->name('subscription.signup');

Route::get('appointment/{id}', [AppointmentController::class, 'show'])->name('appointment.show');
Route::post('appointment/{id}/registration', [AppointmentController::class, 'registration'])->name(
  'appointment.registration',
);
