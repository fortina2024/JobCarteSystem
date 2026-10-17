<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $fillable = [
        'client_id',
        'job_carte_id',
        'identifiant_vehicule',
        'imsi_sim',
        'type_boitier',
        'num_data',
        'numero_flote',
        'marque',
        'num_immobilisation',
        'nom_ref',
        'num_ref',
        'num_voix',
        'num_serie',
        'num_flotte',
        'date_mise_en_disposition',
        'heure_mise_en_disposition',
        'nouv_num_appel',
        'pin',
        'num_chassis',
        'immatriculation',
    ];

    public function jobCarte(){
        return $this->belongsTo(JobCarte::class);
    }
}
