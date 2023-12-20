<?php

namespace App\Twill\Capsules\Appointments\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
  use HasMedias, HasFiles, HasRevisions;

  protected $dates = ['date'];

  protected $casts = [
    'date' => 'datetime',
  ];

  protected $fillable = ['published', 'title', 'date'];

  public function appointment_registrations(): HasMany
  {
    return $this->hasMany(AppointmentRegistration::class);
  }

  public static function findFuture()
  {
    return static::where('date', '>=', date('Y-m-d G:i:s'))->get();
  }
}
