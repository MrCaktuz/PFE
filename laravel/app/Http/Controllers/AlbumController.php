<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ******** Page title ********
        $pageTitle = "Albums";
        // ******** Get current season ********
        $team = new Team;
        $currentSeason = $team->getCurrentSeason();
        // ******** Get albums ********
        $album = new Album;
        $albums = $album->getAlbumsFromCurrentSeason($currentSeason);

        return view('album/index', compact('pageTitle', 'albums', 'currentSeason'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        // ******** Page title ********
        $pageTitle = $album->name;

        return view('album/show', compact('pageTitle', 'album'));
    }
}
