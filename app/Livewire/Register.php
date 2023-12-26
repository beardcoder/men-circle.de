<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\EventRegistration;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class Register extends Component
{
  use UsesSpamProtection;

  public $name = '';
  public $email = '';
  public $event = 0;
  public $newsletter = false;
  public $success = false;

  public HoneypotData $extraFields;

  public function mount()
  {
    $this->extraFields = new HoneypotData();
  }

  public function render()
  {
    return view('livewire.register');
  }

  public function register()
  {
    $this->protectAgainstSpam();
    $event = Event::firstWhere('id', $this->event);

    EventRegistration::create([
      'name' => $this->name,
      'email' => $this->email,
      'event_id' => $this->event,
    ]);

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

      $test = Http::withBasicAuth(config('listmonk.user'), config('listmonk.password'))
        ->put(config('listmonk.url') . '/api/subscribers/' . $subscriber['id'], [
          'email' => $this->email,
          'name' => $this->name,
          'lists' => [$event->list, $this->newsletter ? intval(config('listmonk.list')) : null, ...$existingLists],
          'status' => 'enabled',
        ])
        ->json();
    } else {
      Http::withBasicAuth(config('listmonk.user'), config('listmonk.password'))
        ->post(config('listmonk.url') . '/api/subscribers', [
          'email' => $this->email,
          'name' => $this->name,
          'lists' => [$event->list, $this->newsletter ? intval(config('listmonk.list')) : null],
          'status' => 'enabled',
        ])
        ->json();
    }

    $this->success = true;
  }
}
