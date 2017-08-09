<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\Team;
use App\Models\Album;
use App\Models\Practice;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ******** Page title ********
        $pageTitle = "Équipes";
        $team = new Team;
        // ******** Get current season ********
        $currentSeason = $team->getCurrentSeason();
        // ******** Get all teams form current season ********
        $teams = $team->getTeamsFromCurrentSeason($currentSeason);

        return view('team/index', compact('pageTitle', 'teams', 'currentSeason'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(Team $team, Game $game)
    {
        // ******** Page title ********
        $pageTitle = $team->division;
        // ******** Get current date ********
        $currentDate = Carbon::now();
        // ******** Get formated photo src & srcset ********
        $team->getPhotoSrcAndSrcset($team);
        // ******** Get team's next games ********
        $games = $game->getNextGames($currentDate, $team->id, 6);
        // ******** Get results ********
        $results = $game->getResults($currentDate, $team->id, '');
        // ******** Get Coach ********
        $coach = $team->getCoach($team->coach_id);
        // ******** Get assistant ********
        $assistant = $team->getAssistant($team->assistant_id);
        // ******** Get practices ********
        $practice = new Practice;
        $practices = $practice->getPracticesFromTeamID($team->id);
        // ******** Get Players ********
        $players = $team->getPlayers($team->id);        
        // ******** Get team related albums ********
        $album = new Album;
        $albums = $album->getLastAlbums(NULL, $team->id);
    
        return view('team/show', compact('pageTitle', 'team', 'games', 'results', 'coach', 'assistant', 'practices', 'players', 'albums'));
    }
}
