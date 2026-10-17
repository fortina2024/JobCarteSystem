<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    protected $fillable = [
        'job_carte_id',
        'version_dors_chargee',
        'nouv_installation',
        'reinstallation',
        'maintenance',
        'panne',
        'desinstallation',
        'version_dors_chargee',
        'gprs_gsm_verifie',
        'arret_vehicule_verifie',
        'fm_terminal_verifie',
        'voice_kif_verifie',
        'rf_reader_verifie',
        'proximite_verifie',
        'temps_debut_gprs_gsm_verifie',
        'temps_fin_gprs_gsm_verifie',
        'duree_test_arret_vehicule_verifie',
        'distance_arret_vehicule_verifie',
        'vitesse_max_fm_terminal_verifie',
        'rpm_max_fm_terminal_verifie',
        'odo_hrs_moteur_fixe',
        'plage_bande_verte_de',
        'plage_bande_verte_a',
        'sur_regime',
        'calibration_vitesse',
        'par_distance_fixe',
        'par_tableau',
        'vitesse_gps',
        'can',
        'observation',
    ];

    protected $casts = [
        'gprs_gsm_verifie' => 'boolean',
        'arret_vehicule_verifie' => 'boolean',
        'fm_terminal_verifie' => 'boolean',
        'voice_kif_verifie' => 'boolean',
        'rf_reader_verifie' => 'boolean',
        'proximite_verifie' => 'boolean',
        'calibration_vitesse' => 'boolean',
        'par_distance_fixe' => 'boolean',
        'par_tableau' => 'boolean',
        'vitesse_gps' => 'boolean',
        'can' => 'boolean',
    ];

    public function jobCarte()
    {
        return $this->belongsTo(JobCarte::class);
    }

}
