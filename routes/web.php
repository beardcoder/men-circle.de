<?php

use App\Http\Controllers\Frontend\AppointmentController;
use App\Http\Controllers\Frontend\PageDisplayController;
use Illuminate\Support\Facades\Route;

Route::middleware(['cacheResponse'])->group(function () {
  Route::get('/', [PageDisplayController::class, 'home'])->name('frontend.home');

  Route::get('{slug}', [PageDisplayController::class, 'show'])->name('frontend.page');

  Route::get('events/next', [AppointmentController::class, 'next'])->name('events.next');
  Route::get('events/{id}', [AppointmentController::class, 'show'])->name('events.show');
  Route::get('appointment/{id}', [AppointmentController::class, 'show'])->name('appointment.show');
});
