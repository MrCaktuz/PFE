<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Role extends Model
{
        public function users()
    {
        return $this -> belongsToMany('App\Users', 'role_user');
    }
}
