<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'albums';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = [
        'name', 'photos',
    ];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'photos' => 'array'
    ];


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
    public function teams()
    {
        return $this -> belongsToMany( 'App\Models\Team', 'album_team' );
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            if (count((array)$obj->photos)) {
                foreach ($obj->photos as $file_path) {
                    \Storage::disk('public_folder')->delete($file_path);
                }
            }
        });
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
    public function setPhotosAttribute($value)
    {
        $attribute_name = "photos";
        $disk = "public_folder";
        $destination_path = "uploads/albums";
        $album_name = $_POST['name'];
        foreach ( $value as $file ) {
            // 0. Generate new size file
            $image = \Image::make( $file );
            $image_350 = \Image::make( $file ) -> widen( 350 );
            
            // 1. Generate new file names
            $new_file_name = md5( $file -> getClientOriginalName() . time() ).'.'.$file->getClientOriginalExtension();
            $new_file_name_350 = md5( $file -> getClientOriginalName() . time() ).'_350.'.$file->getClientOriginalExtension();
            
            // 2. Move new files to the correct path
            $file_path = $destination_path . '/' . $album_name . '/' . $new_file_name;
            $file_path_350 = $destination_path . '/' . $album_name . '/' . $new_file_name_350;
            \Storage::disk( $disk )->put( $file_path, $image -> stream() );
            \Storage::disk( $disk )->put( $file_path_350, $image_350 -> stream() );
            
            // 3. Add the public path to the database
            $attribute_value[] = [ $file_path, $file_path_350 ];
        }
        $this->attributes[$attribute_name] = json_encode($attribute_value);
    }
    
}
