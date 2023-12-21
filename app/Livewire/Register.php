<?php

namespace App\Livewire;

use App\Models\AppointmentRegistration;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class Register extends Component
{
  use UsesSpamProtection;

  public $name = '';
  public $email = '';
  public $appointment = 0;
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

    AppointmentRegistration::create([
      'name' => $this->name,
      'email' => $this->email,
      'appointment_id' => $this->appointment,
    ]);

    if ($this->newsletter) {
      Http::withBasicAuth(config('listmonk.user'), config('listmonk.password'))->post(
        config('listmonk.url') . '/api/subscribers',
        [
          'email' => $this->email,
          'name' => $this->name,
          'lists' => [intval(config('listmonk.list'))],
        ],
      );
    }

    $this->success = true;
  }
}
