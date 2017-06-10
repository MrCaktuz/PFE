<?php

namespace App;

use Backpack\CRUD\CrudTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;

class User extends Authenticatable
{

	use CrudTrait;
    use Notifiable;




    /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

	protected $table = 'users';
	// protected $primaryKey = 'id';
	// protected $guarded = [];
	protected $hidden = [
        'password', 'remember_token',
    ];
	protected $fillable = [
		'civility', 'name', 'birth_date', 'birth_location', 'email', 'password', 'phone', 'national_id', 'photo', 'job', 'address', 'postal_code', 'city', 'family_id', 'jersey_nbr',
	];
	public $timestamps = true;
	
	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/
	public function roles()
    {
        return $this -> belongsToMany('App\Models\Role', 'role_user');
    }
    public function family()
    {
        return $this -> belongsTo('App\Models\Family', 'family_id', 'id');
    }
    public function Teams()
    {
        return $this->belongsToMany('App\Models\Team', 'team_user');
    }

	/*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/
	public function getUserLink()
    {
        return url( '/admin/user/' . $this->id );
    }

    public function getShowButton()
    {
        return '<a class="btn btn-default btn-xs" href="'.$this->getUserLink().'" target="_blank"><i class="fa fa-eye"></i> Aperçu</a>';
    }

	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/
	/**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope( 'ordered', function( Builder $builder ) {
            $builder->orderBy( 'name' );
        } );
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

	/*
	|--------------------------------------------------------------------------
	| ACCESORS
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/

	
}