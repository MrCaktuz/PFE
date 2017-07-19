<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Carbon\Carbon;
use App\Models\Game;
use App\Models\Event;
use App\Models\Album;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        // ******** Get current date ********
        $dateNow = Carbon::now();
        // ******** Get the title ********
        $DB_title = DB::table('home') -> select('value') -> where('key', 'title') -> get();
        $title = $DB_title[0]->value;
        // ******** Get the slogan ********
        $DB_slogan = DB::table('home') -> select('value') -> where('key', 'slogan') -> get();
        $slogan = $DB_slogan[0]->value;
        // ******** Get the banner image url ********
        $DB_img = DB::table('home') -> select('value') -> where('key', 'img') -> get();
        $img = $DB_img[0]->value;
        $imgSplited = preg_split( '/\./', $img );
        $imgName = $imgSplited[0];
        $imgExt = $imgSplited[1];
        $imgSrc = $img;
        $imgSrcset = $imgName.'_1280.'.$imgExt.' 1280w,'.$imgName.'_980.'.$imgExt.' 980w,'.$imgName.'_640.'.$imgExt.' 640w';
        // ******** Get next matchs ********
        $nextGames = new Game;
        $nextGames = $nextGames -> getNextGames($dateNow, 6);
        // ******** Get next events ********
        $nextEvents = new Event;
        $nextEvents = $nextEvents -> getNextEvents($dateNow, 6);
        // ******** Get all sponsors ********
        $sponsors = new Sponsor;
        $sponsors = $sponsors -> getAllSponsors();
        // ******** Get last albums ********
        $album = new Album;
        $albums = $album -> getLastAlbums(3);

        return view('home', compact('title', 'slogan', 'imgSrc', 'imgSrcset', 'nextGames', 'nextEvents', 'sponsors', 'albums'));
    }
    public function comity()
    {
        // ******** Get the introductions ********
        $DB_sloganCA = DB::table('comity') -> select('value') -> where('key', 'intro_ca') -> get();
        $sloganCA = $DB_sloganCA[0]->value;
        $DB_sloganACA = DB::table('comity') -> select('value') -> where('key', 'intro_aca') -> get();
        $sloganACA = $DB_sloganACA[0]->value;
        // ******** Get all CA members ********
        $user = new User;
        $membersCA = $user -> getCAmembers();
        $membersACA = $user -> getACAmembers();

        return view('comity', compact('sloganCA', 'sloganACA', 'membersCA', 'membersACA'));
    }
    public function connected( User $user )
    {
    	return view( 'connected' );
    }
    public function reseted( User $user )
    {
        return view( 'reseted' );
    }
    public function mailsent( User $user )
    {
        return view( 'mailsent' );
    }
}
