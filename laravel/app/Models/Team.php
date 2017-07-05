<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Team extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'teams';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'division', 'coach', 'assisstant', 'season', 'photo'
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function users()
    {
        return $this->belongsToMany('App\User', 'team_user');
    }
    
    public function coach()
    {
        return $this->hasOne('App\User', 'id', 'coach_id');
    }

    public function assistant()
    {
        return $this->hasOne('App\User', 'id', 'assistant_id');
    }

    public function games()
    {
        return $this->hasMany( 'App\Models\Game', 'team_id', 'id' );
    }
    public function albums()
    {
        return $this -> belongsToMany('App\Models\Album', 'album_team');
    }


    // public function photos()
    // {
    //     return $this->belongsToMany('App\Photo', 'photo_team');
    // }

    // public function games()
    // {
    //     return $this->hasMany('App\Game', 'team_id');
    // }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope( 'ordered', function( Builder $builder ) {
            $builder->orderBy( 'season', 'desc' );
        } );
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
        $destination_path = "uploads/teams";

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
            $image1280 = \Image::make( $value )->widen( 1280 );
            $image980 = \Image::make( $value )->widen( 980 );
            $image768 = \Image::make( $value )->widen( 768 );
            $image480 = \Image::make( $value )->widen( 480 );

            // 1. Generate a filename.
            $filename = md5( $value.time() );

            // 2. Store the image original on disk.
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '.jpg', $image -> stream() );
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '_1280.jpg', $image1280 -> stream() );
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '_980.jpg', $image980 -> stream() );
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '_768.jpg', $image768 -> stream() );
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '_480.jpg', $image480 -> stream() );

            // 3. Save the path to the database
            $this -> attributes[ $attribute_name ] = $destination_path . '/' . $filename;

        }
    }
}
