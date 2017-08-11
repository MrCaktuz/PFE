<?php

namespace App\Models;

use DB;
use URL;
use App\Models\Album;
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
    public function getAlbumID()
    {
        $albumID = $this->id;
        return $albumID;
    }
    public function showAlbumButton()
    {
        $albumID = $this->getAlbumID();
        $htmlCode = '<a class="btn btn-default btn-xs" href="/album/' . $albumID . '" target="_blanc"><i class="fa fa-eye"></i> Aperçu</a>';
        return $htmlCode;
    }
    public function convertPhotosValueToArray($albums)
    {
        foreach ($albums as $album) {
            $photos = $album->photos;
            $photos = str_replace( '[', '', $photos );
            $photos = str_replace( ']', '', $photos );
            $photos = str_replace( '"', '', $photos );
            $photosSplited = preg_split( '/, /', $photos );
            $aPhotosSrc = [];
            $aPhotosSrcset = [];
            for ($i=0; $i < count($photosSplited); $i++) { 
                if (($i % 2) == 0) {
                    array_push( $aPhotosSrc, URL::to('/').'/'.$photosSplited[$i]);
                } else{
                    array_push( $aPhotosSrcset, URL::to('/').'/'.$photosSplited[$i].' 350w');
                }
            }
            $album->src = $aPhotosSrc;
            $album->srcset = $aPhotosSrcset;
        }

        return $albums;
    }
    public function getLastAlbums($count, $teamID)
    {
        if ($teamID == NULL) {
            if ($count != NULL) {
                $lastAlbums = DB::table('albums') -> orderby('created_at', 'DSC') -> limit($count) -> get();
            } else {
                $lastAlbums = DB::table('albums') -> orderby('created_at', 'DSC') -> get();
            }
        } else {
            if ($count != NULL) {
                $lastAlbums = DB::table('albums') -> leftjoin('album_team', 'album_team.album_id', '=', 'albums.id') -> where('album_team.team_id', '=', $teamID) -> orderby('created_at', 'DSC') -> limit($count) -> get();
            } else {
                $lastAlbums = DB::table('albums') -> leftjoin('album_team', 'album_team.album_id', '=', 'albums.id') -> where('album_team.team_id', '=', $teamID) -> orderby('created_at', 'DSC') -> get();
            }
        }
        // ******** Convert string into array ********
        $album = new Album;
        $lastAlbums = $album->convertPhotosValueToArray($lastAlbums);

        return $lastAlbums;
    }

    public function getAlbumsFromCurrentSeason($currentSeason)
    {
        // ******** Split date of current season ********
        $currentSeasonSplited = preg_split( '/ - /', $currentSeason );
        $seasonStart = $currentSeasonSplited[0];
        $seasonEnd = $currentSeasonSplited[1];
        // ******** Get limiting dates ********
        $beginingDate = $seasonStart.'-08-01';
        $endingDate = $seasonEnd.'-05-31';
        // ******** Get albums from current season ********
        $albums = DB::table('albums') -> whereBetween('created_at', array($beginingDate, $endingDate)) -> get();
        // ******** Convert string into array ********
        $album = new Album;
        $albums = $album->convertPhotosValueToArray($albums);

        return $albums;
    }

    public function getComplexeAlbum()
    {
        // ******** Get complexe album ********
        $album = DB::table('albums') -> where('name', '=', 'Complexe') -> get();
        // // ******** Convert string into array ********
        $photos = $album[0]->photos;
        $photos = str_replace( '[', '', $photos );
        $photos = str_replace( ']', '', $photos );
        $photos = str_replace( '"', '', $photos );
        $photosSplited = preg_split( '/, /', $photos );
        $photos = [];
        $j = 0;
        for ($i=0; $i < count($photosSplited)-1; $i++) {
            $photos[$j] = [$photosSplited[$i], $photosSplited[$i+1]];
            $i += 1;
            $j++;
        }
        $album[0]->photos = $photos;
        $album = $album[0];

        return $album;
    }

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
        $album_originalName = $_POST['name'];
        foreach ( $value as $file ) {
            // 0. Generate new size file
            $image = \Image::make( $file );
            $image_350 = \Image::make( $file ) -> widen( 350 );
            
            // 1. Generate new file names & album name
            $album_name = md5( $album_originalName . time() );
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
