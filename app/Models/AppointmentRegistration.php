<?php

namespace App\Models;

use A17\Twill\Models\Model;
use Illuminate\Notifications\Notifiable;

class AppointmentRegistration extends Model
{
  use Notifiable;

  protected $table = 'appointment_registrations';
  protected $fillable = ['name', 'email', 'appointment_id'];
}
