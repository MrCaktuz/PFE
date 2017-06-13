<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model 
{

    protected $table = 'users';
    public $timestamps = true;
    protected $fillable = array('jersey_nbr');

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_user');
    }

    public function Teams()
    {
        return $this->belongsToMany('App\Models\Team', 'team_user');
    }

    public function family()
    {
        return $this->belongsTo('App\Models\Family');
    }

}