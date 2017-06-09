<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model 
{

    protected $table = 'photos';
    public $timestamps = true;

    public function teams()
    {
        return $this->belongsToMany('App\Team', 'team_user');
    }

}