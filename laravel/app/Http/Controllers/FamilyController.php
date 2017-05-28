<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
	{
        $families = DB::Table( 'users' )->select( 'family_name', 'family_slug' )->orderBy('family_name')->distinct()->get();

		return view('family.index', compact( 'families' ));
	}
	public function show( $slug )
	{
		$familyMembers = DB::Table( 'users' )->where( 'family_slug', '=', $slug )->get();
		$oFamilyName = DB::Table( 'users' )->select( 'family_name' )->where( 'family_slug', '=', $slug )->first();
		$familyName = $oFamilyName->family_name;

		return view('family.show', compact( 'familyMembers', 'familyName' ));
	}
}
