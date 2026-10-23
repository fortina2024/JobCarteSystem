<?php

namespace App\Mail;

use App\Models\JobCarte;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobCarteDeletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public JobCarte $jobCarte) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Annulation de la Job Carte '.$this->jobCarte->num_job_carte,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.job-cartes.deleted',
        );
    }
}
