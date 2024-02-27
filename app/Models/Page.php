<?php

namespace App\Models;

use A17\Twill\Helpers\BlockRenderer;
use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasFiles;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;
use Illuminate\Support\Facades\Cache;

class Page extends Model implements Sortable
{
  use HasBlocks, HasSlug, HasMedias, HasFiles, HasRevisions, HasPosition;

  protected $fillable = ['published', 'title', 'description', 'position'];

  public $slugAttributes = ['title'];

  public function renderBlocks($blockViewMappings = [], $data = [])
  {
    $blocks = Cache::rememberForever("pages.{$this->id}.blocks", function () use ($blockViewMappings, $data) {
      return BlockRenderer::fromEditor($this, 'default')->render($blockViewMappings, $data);
    });
    return $blocks;
  }
}
