<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public string $unsubscribeToken;

    public function __construct($email, $unsubscribeToken)
    {
        $this->email = $email;
        $this->unsubscribeToken = $unsubscribeToken;
    }

    public function build()
    {
        return $this->subject('Gracias por suscribirte a nuestro boletín')
                    ->view('emails.newsletter_confirmation')
                    ->with([
                        'email' => $this->email,
                        'unsubscribeUrl' => route('newsletter.unsubscribe', $this->unsubscribeToken),
                    ]);
    }
}
