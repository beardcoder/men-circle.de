<?php

namespace App\Models;

use A17\Twill\Models\Model;
use Illuminate\Notifications\Notifiable;

class EventRegistration extends Model
{
  use Notifiable;

  protected $table = 'event_registrations';
  protected $fillable = ['name', 'email', 'event_id'];
}
