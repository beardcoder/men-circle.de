<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Signup extends Mailable
{
  use Queueable, SerializesModels;

  private $name;
  private $email;

  /**
   * Create a new message instance.
   */
  public function __construct(string $name, string $email)
  {
    $this->name = $name;
    $this->email = $email;
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      from: new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
      replyTo: [new Address($this->email, $this->name)],
      subject: 'Order Shipped',
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    return new Content(
      view: 'mail.signup',
      with: [
        'name' => $this->name,
        'email' => $this->email,
      ],
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
  public function attachments(): array
  {
    return [];
  }
}
