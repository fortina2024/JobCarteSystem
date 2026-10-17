<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{

    protected $fillable = [
        'job_carte_id',
        'peinture_etat_ext',
        'panneaux_inter',
        'demarrage_vehicule',
        'instruments',
        'radio',
        'affichage_code_defaut_tab',
        'eclairage_ext',
        'feux',
        'detresse',
        'peinture_etat_ext_avant',
        'peinture_etat_ext_apres',
        'panneaux_inter_avant',
        'panneaux_inter_apres',
        'demarrage_vehicule_avant',
        'demarrage_vehicule_apres',
        'instruments_avant',
        'instruments_apres',
        'radio_avant',
        'radio_apres',
        'affichage_code_defaut_tab_avant',
        'affichage_code_defaut_tab_apres',
        'eclairage_ext_avant',
        'eclairage_ext_apres',
        'feux_avant',
        'feux_apres',
        'detresse_avant',
        'detresse_apres',
        'autre_commentaire',
    ];
    
    public function jobCarte(){
        return $this->belongsTo(JobCarte::class);
    }
}
