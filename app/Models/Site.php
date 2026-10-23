<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
     protected $fillable = ['nom','client_id','subgroup_id','group_id','type'];

    public function vehicules()
    {
        return $this->HasMany(Vehicule::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    public function jobCartes()
    {
        return $this->hasMany(JobCarte::class, 'site_id');
    }

    public function asset() 
    {
        return $this->hasMany(Asset::class, 'SiteId', 'subgroup_id');
    }
}