<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempsSupplementaire extends Model
{
    use HasFactory;

    protected $table = 'temps_supplementaires';

    protected $fillable = [
        'debut_heure_suppl',
        'fin_heure_suppl',
        'temps_attente_pour',
        'debut_attente',
        'fin_attente',
        'job_carte_id',
    ];

    protected $casts = [
        'debut_heure_suppl' => 'datetime',
        'fin_heure_suppl' => 'datetime',
        'temps_attente_pour' => 'datetime',
        'debut_attente' => 'datetime',
        'fin_attente' => 'datetime',
    ];

    public function jobCarte()
    {
        return $this->belongsTo(JobCarte::class);
    }
}