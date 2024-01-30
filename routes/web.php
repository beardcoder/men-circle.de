<?php

use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\PageDisplayController;
use App\Models\Page;
use Illuminate\Support\Facades\Route;

Route::middleware(['cacheResponse'])->group(function () {});

Route::get('/page/{page:slug}', function (Page $page) {
  return $page;
});

Route::get('/', [PageDisplayController::class, 'home'])->name('frontend.home');
Route::get('{slug}', [PageDisplayController::class, 'show'])->name('frontend.page');
Route::get('events/next', [EventController::class, 'next'])->name('events.next');
Route::get('events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('event/{event}', [EventController::class, 'show'])->name('event.show');

Route::get('events/{event}/ical', [EventController::class, 'ical'])->name('event.ical');
Route::post('newsletter/register', [NewsletterController::class, 'register'])->name('newsletter.register');
Route::post('events/{event}/register', [EventController::class, 'register'])->name('events.register');
