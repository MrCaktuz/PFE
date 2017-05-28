<?php

namespace App;

use App\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function roles()
    {
        return $this -> belongsToMany('App\Role', 'role_user');
    }

    public static function isAdmin( $userID )
    {
        $user = DB::Table( 'users' )->where( 'id', '=', '$userID' )->get();
        foreach( $user->roles as $role ){
            if( $role->title == "AdminAll" ){
                $validated = 1;
            }
        }
        return $validated;
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
