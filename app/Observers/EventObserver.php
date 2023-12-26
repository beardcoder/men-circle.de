<?php

namespace App\Observers;

use Illuminate\Support\Facades\App;
use App\Helpers\DateHelper;
use App\Models\Event;
use Illuminate\Support\Facades\Http;

class EventObserver
{
  /**
   * Handle the Setting "created" event.
   */
  public function created(Event $event): void
  {
    $res = Http::withBasicAuth(config('listmonk.user'), config('listmonk.password'))
      ->post(config('listmonk.url') . '/api/lists', [
        'name' => $event->title . ' - ' . DateHelper::getLocalDate($event->date)->formatLocalized('%d.%m.%Y %H:%M'),
        'type' => 'private',
        'optin' => 'single',
        'tags' => [App::environment()],
      ])
      ->json();

    $event->list = $res['data']['id'];
    $event->save();
  }

  /**
   * Handle the Setting "updated" event.
   */
  public function updated(Event $event): void
  {
    Http::withBasicAuth(config('listmonk.user'), config('listmonk.password'))
      ->put(config('listmonk.url') . '/api/lists/' . $event->list, [
        'name' => $event->title . ' - ' . DateHelper::getLocalDate($event->date)->formatLocalized('%d.%m.%Y %H:%M'),
        'list_id' => $event->list,
        'tags' => [App::environment()],
      ])
      ->json();
  }

  /**
   * Handle the Setting "updated" event.
   */
  public function deleted(Event $event): void
  {
    Http::withBasicAuth(config('listmonk.user'), config('listmonk.password'))->delete(
      config('listmonk.url') . '/api/lists/' . $event->list,
      [
        'list_id' => $event->list,
      ],
    );
  }
}
