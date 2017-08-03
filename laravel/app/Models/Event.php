<?php

namespace App\Models;

use DB;
use URL;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
    protected $fillable = [ 'title', 'date', 'location', 'reservation', 'description', 'photo' ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getNextEvents($date, $limit)
    {
        // ******** get the next games ********
        $events = DB::table('events') -> where('date','>=', $date) -> orderby('date') -> limit($limit) -> get();
        foreach( $events as $event ){
            // ******** Format the date ********
            $date = $event->date;
            $dateSplited = preg_split( '/-/', $date );
            $months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
            $dateMonth = $months[intval($dateSplited[1])-1];
            $dateDay = $dateSplited[2];
            $dateYear = $dateSplited[0];
            $dateFormated = $dateDay.' '.$dateMonth.' '.$dateYear;
            $event->date = $dateFormated;
            // ******** Get src & srcset ********
            $this->getPhotoSrcAndSrcset($event);
        }
        return $events;
    }

    public function getPhotoSrcAndSrcset($event)
    {
        if ($event->photo) {
            $event->src = URL::to('/').'/'.$event->photo . '.jpg';
            $event->srcset = URL::to('/').'/'.$event->photo.'_480.jpg 480w, '.URL::to('/').'/'.$event->photo . '_300.jpg 300w';
        } else {
            $event->src = URL::to('/').'/img/default-event/event.jpg';
            $event->srcset = URL::to('/').'/img/default-event/event_480.jpg 480w, '.URL::to('/').'/img/default-event/event_300.jpg 300w';
        }

        return $event;
    }

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
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope( 'ordered', function( Builder $builder ) {
            $builder->orderBy( 'date' );
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
        $destination_path = "uploads/evens";

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
            $image300 = \Image::make( $value )->fit( 300, 200 );
            $image480 = \Image::make( $value )->fit( 480, 320 );

            // 1. Generate a filename.
            $filename = md5( $value.time() );

            // 2. Store the image original on disk.
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '.jpg', $image -> stream() );
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '_300.jpg', $image300 -> stream() );
            \Storage::disk( $disk )->put( $destination_path . '/' . $filename . '_480.jpg', $image480 -> stream() );

            // 3. Save the path to the database
            $this -> attributes[ $attribute_name ] = $destination_path . '/' . $filename;

        }
    }
}
