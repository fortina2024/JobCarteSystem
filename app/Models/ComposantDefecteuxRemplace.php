<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComposantDefecteuxRemplace extends Model
{
    protected $fillable = ['nom','ancien_num_serie','nouveau_num_serie','job_carte_id'];
    
    public function jobCarte(){
        return $this->belongsTo(JobCarte::class);
    }
}
