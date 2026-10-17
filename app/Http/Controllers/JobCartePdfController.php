<?php

namespace App\Http\Controllers;

use App\Models\JobCarte;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class JobCartePdfController extends Controller
{
    public function generate(JobCarte $record)
    {
        $record->load([
            'client',
            'vehicule',
            'inspection',
            'temps_supplementaire',
            'cout_prestation',
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
