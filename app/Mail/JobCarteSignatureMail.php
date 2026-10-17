<?php

namespace App\Mail;

use App\Models\JobCarte;
use App\Models\Vehicule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobCarteSignatureMail extends Mailable
{
    use Queueable, SerializesModels;
    public JobCarte $jobCarte;
    public string $signatureLink;

    /**
     * Create a new message instance.
     */
    public function __construct(JobCarte $jobCarte, string $signatureLink)
    {
        $this->jobCarte = $jobCarte;
        $this->signatureLink = $signatureLink;
    }

    /*public function build()
    {
        return $this
            ->subject('Job Carte à signer - ' . $this->jobCarte->num_job_carte)
            ->view('emails.job-cartes.signature');
    }*/

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Job Carte à signer',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'job-cartes.show',
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.job-carte', [
            'record' => $this->jobCarte
        ]);
        $pdfOutput = $pdf->output(); 
        // -----------------------------------------------------------------

        return [
            Attachment::fromData(fn () => $pdfOutput, 'Job-Carte-' . $this->jobCarte->num_job_carte . '.pdf')
                ->withMime('application/pdf'),
        ];

    }

    
}
