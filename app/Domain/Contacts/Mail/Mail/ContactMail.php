<?php

namespace App\Domain\Contacts\Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Contact Mail',
    //     );
    // }
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }
    // public function attachments(): array
    // {
    //     return [];
    // }

    // public function build()
    // {
    //     return $this->from('john@webslesson.info')->subject('New Customer Equiry')->view('dynamic_email_template')->with('data', $this->data);
    // }
}
