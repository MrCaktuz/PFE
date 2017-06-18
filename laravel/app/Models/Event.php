<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Event extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'events';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [ 'title', 'description', 'photo' ];
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

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

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
            $image500 = \Image::make( $value )->widen( 500 );
            $image250 = \Image::make( $value )->widen( 250 );

            // 1. Generate a filename.
            $filename = md5( $value.time() );

            // 2. Store the image original on disk.
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '.jpg', $image -> stream() );
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '_500x500.jpg', $image500 -> stream() );
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '_250x250.jpg', $image250 -> stream() );

            // 3. Save the path to the database
            $this -> attributes[ $attribute_name ] = $destination_path . '/' . $filename . '.jpg';

        }
    }
}
