<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    
    protected $fillable = ['nom','group_id','email','type','display_time_zone'];
    
    public function sites(){
        return $this->HasMany(Site::class);
    }

    public function jobCartes()
    {
        return $this->hasMany(JobCarte::class);
    }
    
}
