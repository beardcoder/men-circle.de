<?php

namespace App\Observers;

use App\Models\AppointmentRegistration;
use App\Notifications\NewAppointmentRegistration;
use Illuminate\Support\Facades\Notification;

class AppointmentRegistrationObserver
{
  /**
   * Handle the Setting "created" event.
   */
  public function created(AppointmentRegistration $appointmentRegistration): void
  {
    $appointmentRegistration->notify(new NewAppointmentRegistration($appointmentRegistration));
  }
}
