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
        $team = new Team;
        // ******** Get current season ********
        $currentSeason = $team->getCurrentSeason();
        // ******** Get all teams form current season ********
        $teams = $team->getTeamsFromCurrentSeason($currentSeason);

        return view('team/index', compact('teams', 'currentSeason'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(Team $team, Game $game)
    {
        // ******** Get current date ********
        $currentDate = Carbon::now();
        // ******** Get formated photo src & srcset ********
        $team->getPhotoSrcAndSrcset($team);
        // ******** Get team's next games ********
        $games = $game->getNextGames($currentDate, $team->id, 6);
        // ******** Get results ********
        $results = $game->getResults($currentDate, $team->id);
        // ******** Get Coach ********
        $coach = $team->getCoach($team->coach_id);
        $coach = $coach[0];
        // ******** Get assistant ********
        $assistant = $team->getAssistant($team->assistant_id);
        if (count($assistant) != 0) {
            $assistant = $assistant[0];
        } else {
            $assistant = null;
        }
        // ******** Get practices ********
        $practice = new Practice;
        $practices = $practice->getPracticesFromTeamID($team->id);
        // ******** Get Players ********
        $players = $team->getPlayers($team->id);        
        // ******** Get team related albums ********
        $album = new Album;
        $albums = $album->getLastAlbums(NULL, $team->id);
    
        return view('team/show', compact('team', 'games', 'results', 'coach', 'assistant', 'practices', 'players', 'albums'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
