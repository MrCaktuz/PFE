<?php

namespace App\Models;

use DB;
use Carbon\Carbon;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Game extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'games';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = [
        'team_id', 'division', 'game_id', 'date', 'time', 'appointment', 'host', 'visitor', 'score', 'duty', 'day_id', 'location',
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getNextGames($date, $limit)
    {
        // ******** get the next games ********
        $games = DB::table('games') -> where('date','>=', $date) -> orderby('date') -> limit($limit) -> get();
        foreach( $games as $game ){
            // ******** Replace team_id by the team division ********
            $DB_teamDivision = DB::table('teams') -> select('division') -> where('id', '=', $game->team_id) -> get();
            $game->team_id = $DB_teamDivision[0]->division;
            // ******** Format the date ********
            $date = $game->date;
            $dateSplited = preg_split( '/-/', $date );
            $months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
            $dateMonth = $months[intval($dateSplited[1])-1];
            $dateDay = $dateSplited[2];
            $dateFormated = $dateDay.' '.$dateMonth;
            $game->date = $dateFormated;
            // ******** Formate the game time ********
            $game->time = $this->getFormatedTime($game->time);
            // ******** Formate the appointment time ********
            if ($game->appointment !== null) {
                $game->appointment = $this->getFormatedTime($game->appointment);
            }
        }
        return $games;
    }

    public function getFormatedTime( $time )
    {
        $grossTime = $time;
        $timeSplited = preg_split('/:/', $grossTime);
        $timeHour = $timeSplited[0];
        $timeMinute = $timeSplited[1];
        $timeFormated = $timeHour.'h'.$timeMinute;

        return $timeFormated;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function team()
    {
        return $this->hasOne('App\Models\Team', 'id', 'team_id');
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
}
