<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class OtpVerificationMail extends Mailable
{
    public function __construct(
        public string $name,
        public string $otp,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Kode Verifikasi Email HerPlay');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.otp');
    }
}