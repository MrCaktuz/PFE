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
    public function getNextGames($date, $id, $limit)
    {
        // ******** Get the next games ********
        if ($id != NULL) {
            $games = DB::table('games') -> where('date','>=', $date) -> where('team_id', '=', $id) -> orderby('date') -> limit($limit) -> get();
        } else {
            $games = DB::table('games') -> where('date','>=', $date) -> orderby('date') -> limit($limit) -> get();
        }
        // ******** Check if there is content ********
        if (count($games) == null) {
            $games->noGame = "Il n'y a plus de match.";
        } else{
            $games->noGame = false;
            foreach( $games as $game ){
                // ******** Replace team_id by the team division ********
                $game->team_id = $this->getTeamDivisionFromTeamID($game->team_id);
                // ******** Format the date ********
                $game->date = $this->getFormatedDate($game->date);
                // ******** Formate the game time ********
                $game->time = $this->getFormatedTime($game->time);
                // ******** Format the appointment time ********
                if ($game->appointment !== null) {
                    $game->appointment = $this->getFormatedTime($game->appointment);
                }
            }
        }

        return $games;
    }

    public function getResults($date, $id)
    {
        if ($id != NULL) {
            $results = DB::table('games') -> where('date','<', $date) -> where('team_id', '=', $id) -> orderby('date', 'DSC') -> get();
        } else {
            $results = DB::table('games') -> where('date','<', $date) -> orderby('date', 'DSC') -> get();
        }
        // ******** Check if there is content ********
        if (count($results) == null) {
            $results->noResult = "Il n'y a pas encore de résultat disponible.";
        } else{
            $results->noResult = false;
            foreach( $results as $result ){
                // ******** Replace team_id by the team division ********
                $result->team_id = $this->getTeamDivisionFromTeamID($result->team_id);
                // ******** Format the date ********
                $result->date = $this->getFormatedDate($result->date);
                // ******** Format the appointment time ********
                if ($result->appointment !== null) {
                    $result->appointment = $this->getFormatedTime($result->appointment);
                }
                // ******** Format score ********
                $score = $result->score;
                $scoreSplited = preg_split( '/ - /', $score );
                $result->hostScore = intval($scoreSplited[0]);
                $result->visitorScore = intval($scoreSplited[1]);
            }
        }

        return $results;
    }

    public function getTeamDivisionFromTeamID($teamID)
    {
        $DB_teamDivision = DB::table('teams') -> select('division') -> where('id', '=', $teamID) -> get();
        $teamDivision = $DB_teamDivision[0]->division;

        return $teamDivision;
    }
    public function getFormatedDate($date)
    {
        $dateSplited = preg_split( '/-/', $date );
        $months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
        $dateYear = $dateSplited[0];
        $dateMonth = $months[intval($dateSplited[1])-1];
        $dateDay = $dateSplited[2];
        $dateFormated = $dateDay.' '.$dateMonth.' '.$dateYear;
        $date = $dateFormated;

        return $date;
    }

    public function getFormatedTime($time)
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
