<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Observers\EventObserver;
use App\Observers\EventRegistrationObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Observers\SettingObserver;
use A17\Twill\Models\Setting;
use App\Models\Page;
use App\Observers\CacheObserver;

class EventServiceProvider extends ServiceProvider
{
  /**
   * The event to listener mappings for the application.
   *
   * @var array<class-string, array<int, class-string>>
   */
  protected $listen = [
    Registered::class => [SendEmailVerificationNotification::class],
  ];

  /**
   * The model observers for your application.
   *
   * @var array
   */
  protected $observers = [
    EventRegistration::class => [EventRegistrationObserver::class],
    Event::class => [EventObserver::class],
    Setting::class => [CacheObserver::class],
    Page::class => [CacheObserver::class],
    Event::class => [CacheObserver::class],
  ];

  /**
   * Register any events for your application.
   */
  public function boot(): void
  {
    //
  }

  /**
   * Determine if events and listeners should be automatically discovered.
   */
  public function shouldDiscoverEvents(): bool
  {
    return false;
  }
}
