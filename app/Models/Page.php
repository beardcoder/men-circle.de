<?php

namespace App\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;
use App\Traits\ClearsResponseCache;

class Page extends Model implements Sortable
{
  use HasBlocks, HasSlug, HasMedias, HasFiles, HasRevisions, ClearsResponseCache, HasPosition;

  protected $fillable = ['published', 'title', 'description', 'position'];

  public $slugAttributes = ['title'];
}
