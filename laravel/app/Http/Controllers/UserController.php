<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Models\Tool;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function index()
	{
        $users = User::all();
		return view('user.index', compact( 'users' ));
	}

    public function show( User $user )
    {
        $tools = new Tool;
        // ******** Get formated birthday ********
        $user->birthday = $tools->getFormatedDate($user->birthday);
        // ******** Get photo src ********
        $user->src = $user->getPhotoSrc($user->photo);
        // ******** Get photo srcset ********
        $user->srcset = $user->getPhotoSrcset($user->photo);
        // ******** Get family ********
        $user->family = $user->getFamily($user->family_id);
        // ******** Get teams coached ********
        $user->teams = $user->getTeamCoached($user->id);

        return view('user.show', compact('user'));
    }

    public function Trainer()
    {
        // ******** Get the introduction ********
        $DB_intro = DB::table('trainer') -> select('value') -> where('key', 'intro') -> get();
        $intro = $DB_intro[0]->value;
        // ******** Get all trainers ********
        $user = new User;
        $trainers = $user -> getAllTrainers();

        return view('trainer', compact('intro', 'trainers'));
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
}
