<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class PictureMail extends Mailable
{
    public function __construct(public string $senderName, public string $note, public string $picture) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Kartu untukmu dari '.$this->senderName);
    }

    public function content(): Content
    {
        return new Content(view: 'mail.picture-html', text: 'mail.picture');
    }

    public function attachments(): array
    {
        return [Attachment::fromPath(public_path('images/'.config('postcards.'.$this->picture.'.file')))
            ->as(config('postcards.'.$this->picture.'.file'))->withMime('image/jpeg')];
    }
}
