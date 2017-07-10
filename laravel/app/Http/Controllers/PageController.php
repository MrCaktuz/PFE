<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Carbon\Carbon;
use App\Models\Game;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
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
        $date = Carbon::now();
        $nextGames = new Game;
        $nextGames = $nextGames -> getNextGames($date, 6);
        // var_dump($nextGames);

        return view('home', compact('title', 'slogan', 'imgSrc', 'imgSrcset', 'nextGames'));
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
