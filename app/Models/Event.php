<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Model;
use App\Models\EventRegistration;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
  use HasBlocks, HasMedias, HasFiles, HasRevisions;

  protected $dates = ['startDate', 'endDate'];

  protected $casts = [
    'startDate' => 'datetime',
    'endDate' => 'datetime',
  ];

  protected $fillable = [
    'published',
    'title',
    'description',
    'startDate',
    'endDate',
    'list',
    'latitude',
    'longitude',
    'place',
    'streetAddress',
    'addressLocality',
    'postalCode',
    'price',
  ];

  public function event_registrations(): HasMany
  {
    return $this->hasMany(EventRegistration::class);
  }

  public static function findFuture()
  {
    return static::where('startDate', '>=', date('Y-m-d G:i:s'))->get();
  }
}
