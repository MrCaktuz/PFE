<?php

namespace App\Models;

use DB;
use URL;
use App\User;
use App\Models\Team;
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
    public function getCurrentSeason()
    {
        $db_currentSeason = DB::table('teams') -> select('season') -> groupBy('season') -> get();
        $seasons = [];
        foreach ($db_currentSeason as $season) {
            array_push($seasons, $season->season);
        }
        $currentSeason = max($seasons);

        return $currentSeason;
    }
    public function getTeamsFromCurrentSeason($currentSeason)
    {
        $teamModel = new Team;
        $teams = DB::table('teams') -> where('season', '=', $currentSeason) -> get();
        foreach ($teams as $team) {
            $teamModel->getPhotoSrcAndSrcset($team);
        }

        return $teams;
    }

    public function getPhotoSrcAndSrcset($team)
    {
        if ($team->photo) {
            $team->src = URL::to('/').'/'.$team->photo . '.jpg';
            $team->srcset = URL::to('/').'/'.$team->photo.'_480.jpg 480w, '.URL::to('/').'/'.$team->photo . '_768.jpg 768w, '.URL::to('/').'/'.$team->photo . '_980.jpg 980w, '.URL::to('/').'/'.$team->photo . '_1280.jpg 1280w';
        } else {
            $team->src = URL::to('/').'/img/default-team/team.jpg';
            $team->srcset = URL::to('/').'/img/default-team/team_480.jpg 480w, '.URL::to('/').'/img/default-team/team_768.jpg 768w, '.URL::to('/').'/img/default-team/team_980.jpg 980w, '.URL::to('/').'/img/default-team/team_1280.jpg 1280w';
        }
        $team->default = URL::to('/').'/img/default-team/team.jpg';

        return $team;
    }

    public function getPlayers($teamID)
    {
        $players = DB::table('users') -> leftjoin('team_user', 'team_user.user_id', '=', 'users.id') -> leftjoin('teams', 'team_user.team_id', '=', 'teams.id') -> where('teams.id', '=', $teamID) -> get();
        return $players;
    }

    public function getCoach($coachID)
    {
        $user = new User;
        $coach = DB::table('users') -> where('id', '=', $coachID) -> get();
        $coach = $coach[0];
        $coach->src = $user->getPhotoSrc($coach);
        $coach->srcset = $user->getPhotoSrcset($coach);

        return $coach;
    }

    public function getAssistant($assistantID)
    {
        $user = new User;
        $assistant = DB::table('users') -> where('id', '=', $assistantID) -> get();
        if (count($assistant) != 0) {
            $assistant = $assistant[0];
            $assistant->src = $user->getPhotoSrc($assistant);
            $assistant->srcset = $user->getPhotoSrcset($assistant);
        } else {
            $assistant = null;
        }

        return $assistant;
    }

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
    public function practices()
    {
        return $this -> hasMany('App\Models\Practice', 'team_id', 'id');
    }

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
    public function getDivisionSeasonAttribute( $value )
    {
        $division = $this->division;
        $season = $this->season;
        $value = $division.' / '.$season;
        return $value;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setPhotoAttribute( $value )
    {
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
