<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table='Assets';

    public function site()
    {
        return $this->belongsTo(Site::class, 'SiteId', 'subgroup_id');
    }
}
