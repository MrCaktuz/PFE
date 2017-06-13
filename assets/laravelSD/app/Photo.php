<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model 
{

    protected $table = 'photos';
    public $timestamps = true;

    public function album()
    {
        return $this->hasOne('App/Models\Album', 'album_id');
    }

}