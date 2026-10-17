<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    protected $fillable = ['nom','prenom','client_id','contact','email_address'];

    public function client(){
        return $this->belongsTo(Client::class);
    }
}
