<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model 
{

    protected $table = 'families';
    public $timestamps = true;

    public function users()
    {
        return $this->hasMany('App\User', 'family_id');
    }

}