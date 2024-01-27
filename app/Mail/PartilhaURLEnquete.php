<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PartilhaURLEnquete extends Mailable
{
    use Queueable, SerializesModels;

    private $enquete;
    private $remetente;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($enquete, $remetente)
    {
        $this->enquete = $enquete;
        $this->remetente = $remetente;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Convite para Participar de Nossa Enquete',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'painel.emails.partilha_enquete',
            with: [
                'enquete' => $this->enquete,
                'remetente' => $this->remetente,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
