<?php

namespace App\Observers;

use App\Models\EventRegistration;
use A17\Twill\Models\User;
use App\Notifications\NewEventRegistration;
use Illuminate\Support\Facades\Notification;

class EventRegistrationObserver
{
  /**
   * Handle the Setting "created" event.
   */
  public function created(EventRegistration $eventRegistration): void
  {
    $user = User::find(1)->first();
    $user->notify(new NewEventRegistration($eventRegistration));
  }
}
