<?php
namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Facades\Http;

class EventRegisterService
{
  public function __construct(
    private Event $event,
    private string $name,
    private string $email,
    private bool $newsletter,
  ) {
  }

  public function updateOrCreateSubscriber()
  {
    $res = Http::withBasicAuth(config('listmonk.user'), config('listmonk.password'))
      ->get(config('listmonk.url') . '/api/subscribers?query=subscribers.email LIKE \'' . $this->email . '\'')
      ->json();
    if (count($res['data']['results']) >= 1) {
      $subscriber = $res['data']['results'][0];
      $existingLists = [];

      if (count($subscriber['lists']) >= 1) {
        foreach ($subscriber['lists'] as $list) {
          $existingLists[] = $list['id'];
        }
      }

      Http::withBasicAuth(config('listmonk.user'), config('listmonk.password'))
        ->put(config('listmonk.url') . '/api/subscribers/' . $subscriber['id'], [
          'name' => $this->name,
          'email' => $this->email,
          'lists' => [
            $this->event->list,
            $this->newsletter ? intval(config('listmonk.list')) : null,
            ...$existingLists,
          ],
          'status' => 'enabled',
        ])
        ->json();
    } else {
      Http::withBasicAuth(config('listmonk.user'), config('listmonk.password'))
        ->post(config('listmonk.url') . '/api/subscribers', [
          'email' => $this->email,
          'name' => $this->name,
          'lists' => [$this->event->list, $this->newsletter ? intval(config('listmonk.list')) : null],
          'status' => 'enabled',
        ])
        ->json();
    }
  }
}
