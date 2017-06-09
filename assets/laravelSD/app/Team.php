<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model 
{

    protected $table = 'teams';
    public $timestamps = true;
    protected $fillable = array('coach_id', 'assistant_id');

    public function users()
    {
        return $this->belongsToMany('App\User', 'team_user');
    }

    public function photos()
    {
        return $this->belongsToMany('App\Photo', 'photo_team');
    }

    public function games()
    {
        return $this->hasMany('App\Game', 'team_id');
    }

    public function coach()
    {
        return $this->hasOne('App\User', 'coach_id');
    }

    public function assisstant()
    {
        return $this->hasOne('App\User', 'assisstant_id');
    }

}