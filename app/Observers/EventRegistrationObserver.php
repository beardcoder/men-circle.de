<?php

namespace App\Observers;

use App\Models\EventRegistration;
use App\Notifications\NewEventRegistration;
use Illuminate\Support\Facades\Notification;

class EventRegistrationObserver
{
  /**
   * Handle the Setting "created" event.
   */
  public function created(EventRegistration $eventRegistration): void
  {
    $eventRegistration->notify(new NewEventRegistration($eventRegistration));
  }
}
