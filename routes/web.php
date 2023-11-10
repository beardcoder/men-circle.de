<?php

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

Route::get('/', [
  \App\Http\Controllers\PageDisplayController::class,
  'home',
])->name('frontend.home');
Route::get('{slug}', [
  \App\Http\Controllers\PageDisplayController::class,
  'show',
])->name('frontend.page');

Route::post('subscription/signup', [
  \App\Http\Controllers\SubscriptionController::class,
  'signup',
])
  ->middleware(ProtectAgainstSpam::class)
  ->middleware(DoNotCacheResponse::class)
  ->name('subscription.signup');
