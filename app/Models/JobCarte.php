<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCarte extends Model
{
    
    protected $fillable = [
        'num_job_carte',
        'date',
        'client_id',
        'site_id',
        'user_id',
        'num_commande',
        'signature_technicien',
        'signature_token',
        'signature_token_expires_at',
        'signature_path',
        'signed_by_name',
        'signed_by_email',
        'signed_at',
        'signature_status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function vehicule()
    {
        return $this->HasOne(Vehicule::class);
    }

    public function inspection()
    {
        return $this->HasOne(Inspection::class);
    }

    public function intervention()
    {
        return $this->HasOne(Intervention::class);
    }

    public function temps_supplementaire()
    {
        return $this->HasOne(TempsSupplementaire::class);
    }

    public function infos_supplementaire()
    {
        return $this->HasOne(InfosSupplementaire::class);
    }

    public function cout_prestation()
    {
        return $this->HasOne(CoutPrestation::class);
    }

    public function composant_defecteux_remplace()
    {
        return $this->HasMany(ComposantDefecteuxRemplace::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'signature_token_expires_at' => 'datetime',
            'signed_at' => 'datetime',
            'date' => 'date',
        ];
    }
    
}
