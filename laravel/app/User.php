<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function role()
    {
        return $this -> belongsToMany( User::class );
    }

    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'civility', 'first_name', 'last_name', 'birth_date', 'birth_location', 'email', 'password', 'phone', 'national_id', 'photo', 'job', 'address', 'postal_code', 'city', 'family_name', 'family_chef',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
