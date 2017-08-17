<?php

namespace App\Http\Controllers;

use DB;
use URL;
use App\User;
use Carbon\Carbon;
use App\Models\Rule;
use App\Models\Team;
use App\Models\Game;
use App\Models\Event;
use App\Models\Album;
use App\Models\Sponsor;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{
    public function home(Request $request)
    {
        // ******** Page title ********
        $pageTitle = "Accueil";
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
        $game = new Game;
        $games = $game -> getNextGames($dateNow, null);
        // ******** Get next events ********
        $nextEvents = new Event;
        $nextEvents = $nextEvents -> getNextEvents($dateNow, 6);
        // ******** Get all sponsors ********
        $sponsors = new Sponsor;
        $sponsors = $sponsors -> getAllSponsors();
        // ******** Get last albums ********
        $album = new Album;
        $albums = $album -> getLastAlbums(3, '');
        // ******** Ajax ********
        if ($request->ajax()) {
            return view('ajax.games', ['games' => $games])->render();  
        }

        return view('home', compact('pageTitle', 'title', 'slogan', 'imgSrc', 'imgSrcset', 'games', 'nextEvents', 'sponsors', 'albums'));
    }

    public function rules(Rule $rule)
    {
        // ******** Page title ********
        $pageTitle = "Règlement";
        $rules = $rule->all();

        return view('rules', compact('pageTitle', 'rules'));
    }

    public function calendar(Request $request)
    {
        // ******** Page title ********
        $pageTitle = "Calendrier";
        // ******** Get current date ********
        $dateNow = Carbon::now();
        // ******** Get next matchs ********
        $game = new Game;
        $games = $game -> getNextGames($dateNow, null);
        // ******** Get results ********
        $results = $game->getResults($dateNow, '', 6);
        // ******** Get activities ********
        $activity = new Activity;
        $activities = $activity->getActivities($dateNow);
        // ******** Ajax ********
        if ($request->ajax()) {
            $input = $request->input();
            if (array_key_exists ('games', $input)) {
                return view('ajax.team-games', ['games' => $games])->render();
            } else if (array_key_exists ('results', $input)) {
                return view('ajax.team-results', ['results' => $results])->render();
            }
        }

        return view('calendar', compact('pageTitle', 'games', 'results', 'activities'));
    }

    public function contact( )
    {
        // ******** Page title ********
        $pageTitle = "Contact";
        // ******** Get the introduction ********
        $DB_intro = DB::table('contact') -> select('value') -> where('key', 'intro') -> get();
        $intro = $DB_intro[0]->value;

        return view( 'contact', compact('pageTitle', 'intro') );
    }

    public function contactForm( Request $request )
    {
        $this -> validate( $request, [
            'name' => 'Required|max:255|NotIn:php,ruby',
            'msg' => 'Required|NotIn:php,ruby',
            'obj' => 'Required|NotIn:php,ruby',
            'email' => 'Required|Email',
        ] );
        // ******** Set data ********
        $name = $_POST['name'];
        $email = $_POST['email'];
        $object = $_POST['obj'];
        $message = $_POST['msg'];
        // ******** Get the contact email on every view ********
        $DB_contactEmail = DB::table('settings') -> select('value') -> where('key', 'contact_email') -> get();
        $contactEmail = $DB_contactEmail[0]->value;
        // ******** Get the contact email on every view ********
        $DB_contactCC = DB::table('settings') -> select('value') -> where('key', 'contact_cc') -> get();
        $contactCC = $DB_contactCC[0]->value;
        // ******** Send the e-mail ********
        $headers = 'FROM: ' . $name . '<' . $email . '>';
        mail( $contactEmail, $object.' - Formulaire de contact', $message, $headers );

        return Redirect::route('contact')->with('success', 'Votre message à bien été envoyé. Merci!');
    }

    public function complexe()
    {
        // ******** Page title ********
        $pageTitle = "Complexe sportif";
        // ******** Get data from DB ********
        $DB_complexe = DB::table('complexe') -> select('name', 'value') -> get();
        // ******** Get intro ********
        $intro = $DB_complexe[0]->value;
        // ******** Get details ********
        $details = $DB_complexe[1]->value;
        // ******** get tarif by hour ********
        $hr_small = $DB_complexe[2];
        $hr_big = $DB_complexe[3];
        $hr_bar = $DB_complexe[4];
        // ******** get tarif by day ********
        $dr_small = $DB_complexe[5];
        $dr_big = $DB_complexe[6];
        $dr_bar = $DB_complexe[7];
        $dr_bar_funeral = $DB_complexe[8];
        $dr_bar_kitchen = $DB_complexe[9];
        $dr_bar_kitchen_small = $DB_complexe[10];
        $dr_bar_kitchen_private = $DB_complexe[11];
        // ******** Get complexe album ********
        $album = new Album;
        $albumComplexe = $album->getComplexeAlbum();

        return view( 'complexe', compact('pageTitle', 'albumComplexe', 'intro', 'details', 'hr_small', 'hr_big', 'hr_bar', 'dr_small', 'dr_big', 'dr_bar', 'dr_bar_funeral', 'dr_bar_kitchen', 'dr_bar_kitchen_small', 'dr_bar_kitchen_private') );
    }

    public function moreGames( Game $game)
    {
        global $post;
        $date = Carbon::now();
        $offset = $_POST[ 'offset' ];
        $limit = 3;
        $games = $game->getNextGames($date, '', $limit, $offset);
        if (count($games) != 0){
            include( view( '/ajax/moreGames', compact('games') ) );
        } else {
            return false;
        }
        die();
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
