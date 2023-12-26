<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;
use App\Traits\ClearsResponseCache;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
  use HasBlocks, HasMedias, HasFiles, HasRevisions, ClearsResponseCache;

  protected $dates = ['date'];

  protected $casts = [
    'date' => 'datetime',
  ];

  protected $fillable = ['published', 'title', 'date', 'list', 'latitude', 'longitude', 'place'];

  public function event_registrations(): HasMany
  {
    return $this->hasMany(EventRegistration::class);
  }

  public static function findFuture()
  {
    return static::where('date', '>=', date('Y-m-d G:i:s'))->get();
  }
}
