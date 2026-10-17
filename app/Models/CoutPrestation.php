<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoutPrestation extends Model
{
    protected $fillable = [
        'distance_parcourue_km',
        'materiel',
        'main_oeuvre',
        'tps_attente',
        'deplacement',
        'job_carte_id',
    ];

    public function jobCarte(){
        return $this->belongsTo(JobCarte::class);
    }
}
