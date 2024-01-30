<?php

namespace App\Observers;

use A17\Twill\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Spatie\ResponseCache\Facades\ResponseCache;

class SettingObserver
{
  /**
   * Handle the Setting "created" event.
   */
  public function created(Setting $setting): void
  {
    ResponseCache::clear();
    Cache::flush();
  }

  /**
   * Handle the Setting "updated" event.
   */
  public function updated(Setting $setting): void
  {
    ResponseCache::clear();
    Cache::flush();
  }

  /**
   * Handle the Setting "deleted" event.
   */
  public function deleted(Setting $setting): void
  {
    ResponseCache::clear();
    Cache::flush();
  }

  /**
   * Handle the Setting "restored" event.
   */
  public function restored(Setting $setting): void
  {
    ResponseCache::clear();
    Cache::flush();
  }

  /**
   * Handle the Setting "force deleted" event.
   */
  public function forceDeleted(Setting $setting): void
  {
    ResponseCache::clear();
    Cache::flush();
  }
}
