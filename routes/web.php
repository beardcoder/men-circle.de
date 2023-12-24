<?php

use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\PageDisplayController;
use Illuminate\Support\Facades\Route;

Route::middleware(['cacheResponse'])->group(function () {
  Route::get('/', [PageDisplayController::class, 'home'])->name('frontend.home');

  Route::get('{slug}', [PageDisplayController::class, 'show'])->name('frontend.page');

  Route::get('events/next', [EventController::class, 'next'])->name('events.next');
  Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
  Route::get('event/{id}', [EventController::class, 'show'])->name('event.show');
});
