<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InfosSupplementaire extends Model
{
    protected $table = 'infos_supplementaires';

    protected $fillable = [
        'job_carte_id',
        'observation',
        'ancien_num_serie_sim',
        'nouveau_num_serie_sim',
        'ancien_num_serie_boitier_fm',
        'nouveau_num_serie_boitier_fm',
        'ancien_num_serie_fm_terminal',
        'nouveau_num_serie_fm_terminal',
        'ancien_num_serie_boitier_voice_kit',
        'nouveau_num_serie_boitier_voice_kit',
        'ancien_num_serie_boitier_rf_tag_id',
        'nouveau_num_serie_boitier_rf_tag_id',
    ];

    public function jobCarte(): BelongsTo
    {
        return $this->belongsTo(JobCarte::class);
    }
}