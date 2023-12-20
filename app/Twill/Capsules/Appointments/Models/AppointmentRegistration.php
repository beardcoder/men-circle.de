<?php

namespace App\Twill\Capsules\Appointments\Models;

use A17\Twill\Models\Model;

class AppointmentRegistration extends Model
{
  protected $table = 'appointment_registrations';
  protected $fillable = ['name', 'email', 'appointment_id'];
}
