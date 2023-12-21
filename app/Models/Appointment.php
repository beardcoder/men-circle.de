<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
  use HasMedias, HasFiles, HasRevisions, ClearsResponseCache;

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
