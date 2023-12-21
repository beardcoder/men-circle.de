<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class Newsletter extends Component
{
  use UsesSpamProtection;

  public $name = '';
  public $email = '';
  public $success = false;

  public HoneypotData $extraFields;
  public function mount()
  {
    $this->extraFields = new HoneypotData();
  }
  public function render()
  {
    return view('livewire.newsletter');
  }

  public function register()
  {
    $this->protectAgainstSpam();
    Http::withBasicAuth(config('listmonk.user'), config('listmonk.password'))->post(
      config('listmonk.url') . '/api/subscribers',
      [
        'email' => $this->email,
        'name' => $this->name,
        'lists' => [intval(config('listmonk.list'))],
      ],
    );
    $this->success = true;
  }
}
