<?php

namespace App\Http\Controllers;

use App\Models\JobCarte;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class JobCartePdfController extends Controller
{
    public function generate(JobCarte $record)
    {
        if ($record->trashed()) {
            throw new NotFoundHttpException;
        }

        $record->load([
            'client',
            'vehicule',
            'inspection',
            'temps_supplementaire',
            'user',
        ]);

        $pdf = Pdf::loadView(
            'pdf.job-carte',
            compact('record')
        );

        return $pdf->stream(
            'JobCarte-'.$record->id.'.pdf'
        );
    }
}
