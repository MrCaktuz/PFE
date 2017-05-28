<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view( 'home' );
    }
    public function connected( User $user )
    {
    	return view( 'connected' );
    }
}
