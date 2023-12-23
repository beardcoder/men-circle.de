<?php

namespace App\Observers;

use A17\Twill\Models\Setting;
use Spatie\ResponseCache\Facades\ResponseCache;

class SettingObserver
{
  /**
   * Handle the Setting "created" event.
   */
  public function created(Setting $setting): void
  {
    ResponseCache::clear();
  }

  /**
   * Handle the Setting "updated" event.
   */
  public function updated(Setting $setting): void
  {
    ResponseCache::clear();
  }

  /**
   * Handle the Setting "deleted" event.
   */
  public function deleted(Setting $setting): void
  {
    ResponseCache::clear();
  }

  /**
   * Handle the Setting "restored" event.
   */
  public function restored(Setting $setting): void
  {
    ResponseCache::clear();
  }

  /**
   * Handle the Setting "force deleted" event.
   */
  public function forceDeleted(Setting $setting): void
  {
    ResponseCache::clear();
  }
}
