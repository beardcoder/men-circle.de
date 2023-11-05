<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Model;

class Subscription extends Model
{
  use HasSlug;
  protected $fillable = ['published', 'name', 'email', 'token', 'optin'];

  public $slugAttributes = ['email'];
}
