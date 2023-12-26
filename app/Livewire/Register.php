<?php

namespace App\Livewire;

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

    EventRegistration::create([
      'name' => $this->name,
      'email' => $this->email,
      'event_id' => $this->event,
    ]);

    Http::withBasicAuth(config('listmonk.user'), config('listmonk.password'))->post(
      config('listmonk.url') . '/api/subscribers',
      [
        'email' => $this->email,
        'name' => $this->name,
        'lists' => [intval(config('listmonk.register')), $this->newsletter ? intval(config('listmonk.list')) : null],
        'attribs' => [
          'event' => intval($this->event),
        ],
      ],
    );

    $this->success = true;
  }
}
