<?php

namespace App\Models;

use A17\Twill\Models\Model;

class EventRegistration extends Model
{
  protected $table = 'event_registrations';
  protected $fillable = ['name', 'email', 'event_id'];
}
