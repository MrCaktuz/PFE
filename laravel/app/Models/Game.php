<?php

namespace App\Models;

use DB;
use App\Models\Tool;
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
            $tools = new Tool;
            foreach( $games as $game ){
                // ******** Replace team_id by the team division ********
                $game->team_id = $this->getTeamDivisionFromTeamID($game->team_id);
                // ******** Format the date ********
                $game->date = $tools->getFormatedDate($game->date);
                // ******** Formate the game time ********
                $game->time = $tools->getFormatedTime($game->time);
                // ******** Format the appointment time ********
                if ($game->appointment !== null) {
                    $game->appointment = $tools->getFormatedTime($game->appointment);
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
            $tools = new Tool;
            foreach( $results as $result ){
                // ******** Replace team_id by the team division ********
                $result->team_id = $this->getTeamDivisionFromTeamID($result->team_id);
                // ******** Format the date ********
                $result->date = $tools->getFormatedDate($result->date);
                // ******** Format the appointment time ********
                if ($result->appointment !== null) {
                    $result->appointment = $tools->getFormatedTime($result->appointment);
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
