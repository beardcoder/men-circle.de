<?php

namespace App\Notifications;

use App\Models\EventRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEventRegistration extends Notification
{
  use Queueable;

  /**
   * Create a new notification instance.
   */
  public function __construct(private EventRegistration $eventRegistration)
  {
    //
  }

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['mail'];
  }

  /**
   * Get the mail representation of the notification.
   */
  public function toMail(object $notifiable): MailMessage
  {
    return (new MailMessage())
      ->subject('Neue Anmeldung für den Männerkreis')
      ->salutation('Neue Anmeldung für den Männerkreis')
      ->lines(['Name: ' . $this->eventRegistration->name, 'Email: ' . $this->eventRegistration->email]);
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray(object $notifiable): array
  {
    return [
        //
      ];
  }
}
