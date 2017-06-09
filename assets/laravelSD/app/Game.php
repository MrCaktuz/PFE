<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model 
{

    protected $table = 'games';
    public $timestamps = true;

    public function team()
    {
        return $this->hasOne('App\Team', 'team_id');
    }

}