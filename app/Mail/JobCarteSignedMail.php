<?php

namespace App\Mail;

use App\Models\JobCarte;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobCarteSignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public JobCarte $jobCarte) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation et Job Carte signée - ' . $this->jobCarte->num_job_carte,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'job-cartes.signed', // Créez une petite vue texte pour le corps du mail de confirmation
        );
    }

    public function attachments(): array
    {
        // Génération du PDF (cette fois, $jobCarte->signature_path n'est plus vide !)
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.job-carte', [
            'record' => $this->jobCarte // ou 'jobCarte' selon ce que vous utilisez dans votre vue
        ]);
        
        $pdfOutput = $pdf->output(); 

        return [
            Attachment::fromData(fn () => $pdfOutput, 'Job-Carte-Signee-' . $this->jobCarte->num_job_carte . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}