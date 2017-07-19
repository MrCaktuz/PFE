<?php

namespace App;

use DB;
use Request;
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
    public function hasRole( $roleTitle )
    {
        foreach ( $this->roles()->get() as $role ) {
            if ( $role->title == $roleTitle ) {
                return true;
            }
        }
        return false;
    }

	public function getUserLink()
    {
        return url( '/admin/user/' . $this->id );
    }

    public function getShowButton()
    {
        return '<a class="btn btn-default btn-xs" href="'.$this->getUserLink().'" target="_blank"><i class="fa fa-eye"></i> Aperçu</a>';
    }
    public function shortName( User $user )
    {
        $name = $user->name;
        $splitName = preg_split( '/ /', $name );
        $lastEltPosition = count( $splitName ) - 1;
        $shortName = $splitName[ $lastEltPosition ];
        return $shortName;
    }

    public function getCAmembers()
    {
        $members = [];
        // ******** Get Président ********
        $president = DB::table( 'users' ) -> leftjoin( 'role_user','role_user.user_id','=','users.id' ) -> leftjoin( 'roles', 'role_user.role_id', '=', 'roles.id' ) -> where( 'roles.title', '=', 'Président' ) -> get();
        array_push($members, $president[0]);
        // ******** Get Secretary ********
        $secretary = DB::table( 'users' ) -> leftjoin( 'role_user','role_user.user_id','=','users.id' ) -> leftjoin( 'roles', 'role_user.role_id', '=', 'roles.id' ) -> where( 'roles.title', '=', 'Secrétaire' ) -> get();
        array_push($members, $secretary[0]);
        // ******** Get Manager ********
        $manager = DB::table( 'users' ) -> leftjoin( 'role_user','role_user.user_id','=','users.id' ) -> leftjoin( 'roles', 'role_user.role_id', '=', 'roles.id' ) -> where( 'roles.title', '=', 'Manager' ) -> get();
        array_push($members, $manager[0]);
        // ******** Get Treasurer ********
        $treasurer = DB::table( 'users' ) -> leftjoin( 'role_user','role_user.user_id','=','users.id' ) -> leftjoin( 'roles', 'role_user.role_id', '=', 'roles.id' ) -> where( 'roles.title', '=', 'Trésorier' ) -> get();
        array_push($members, $treasurer[0]);
        // ******** Get CA members ********
        $caMembers = DB::table( 'users' ) -> leftjoin( 'role_user','role_user.user_id','=','users.id' ) -> leftjoin( 'roles', 'role_user.role_id', '=', 'roles.id' ) -> where( 'roles.title', '=', 'Membre CA' ) -> get();
        foreach ($caMembers as $caMember) {
            array_push($members, $caMember);
        }
        // ******** Get associated roles for each member ********
        foreach($members as $member){
            $roles = DB::table('roles') -> select('title') -> leftjoin('role_user', 'role_user.role_id', '=', 'roles.id') -> leftjoin('users', 'role_user.user_id', '=', 'users.id' ) -> where('users.id', '=', $member->user_id ) -> orderby('title') -> get();
            $member->roles = $roles;
        }

        return $members;
    }

    public function getACAmembers()
    {
        $members = DB::table( 'users' ) -> leftjoin( 'role_user','role_user.user_id','=','users.id' ) -> leftjoin( 'roles', 'role_user.role_id', '=', 'roles.id' ) -> where( 'roles.title', '=', 'Assistant CA' ) -> orderby('title') -> get();
        foreach($members as $member){
            $roles = DB::table('roles') -> select('title') -> leftjoin('role_user', 'role_user.role_id', '=', 'roles.id') -> leftjoin('users', 'role_user.user_id', '=', 'users.id' ) -> where('users.id', '=', $member->user_id ) -> get();
            $member->roles = $roles;
        }

        return $members;
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
        static::deleting(function($obj) {
            \Storage::disk('public_folder')->delete($obj->image);
        });
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
	public function setPhotoAttribute( $value ) {
        $attribute_name = "photo";
        $disk = "public_folder";
        $destination_path = "uploads/users";

        // if the image was erased
        if ( $value == null ) {
            // delete the image from disk
            \Storage::disk( $disk ) -> delete( $this -> photo );

            // set null in the database column
            $this -> attributes[ $attribute_name ] = null;
    	}

        // if a base64 was sent, store it in the db
        if ( starts_with( $value, 'data:image' ) ) {
        	// 0. Make the original image size & others
            $image = \Image::make( $value );
            $image250x250 = \Image::make( $value )->fit( 250, 250 );
            $image125x125 = \Image::make( $value )->fit( 125, 125 );
            $image50x50 = \Image::make( $value )->fit( 50, 50 );
            $image25x25 = \Image::make( $value )->fit( 25, 25 );

            // 1. Generate a filename.
            $filename = md5( $value.time() );

            // 2. Store the image original on disk.
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '.jpg', $image -> stream() );
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '_250x250.jpg', $image250x250 -> stream() );
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '_125x125.jpg', $image125x125 -> stream() );
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '_50x50.jpg', $image50x50 -> stream() );
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '_25x25.jpg', $image25x25 -> stream() );

            // 3. Save the path to the database
            $this -> attributes[ $attribute_name ] = $destination_path . '/' . $filename . '.jpg';

        }
    }
}