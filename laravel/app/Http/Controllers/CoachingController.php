<?php

namespace App\Http\Controllers;

use DB;
use URL;
use Auth;
use Storage;
use App\Models\Tool;
use App\Models\Coaching;
use Illuminate\Http\Request;

class CoachingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Coaching $coaching)
    {
        // ******** Get All files ********
        $shared = $coaching->all();
        $tools = new Tool;
        foreach ($shared as $share) {
            $share->author = DB::table('users') -> select('name') -> where('id', '=', $share->user_id) -> get();
            $share->author = $share->author[0]->name;
            $share->date = $tools->getFormatedDateFromTimestamps($share->created_at);
        }
        // ******** Get the introduction ********
        $DB_intro = DB::table('coachingPage') -> select('value') -> where('key', 'intro') -> orderBy('created_at', 'DSC') -> get();
        $intro = $DB_intro[0]->value;

        return view('coaching.index', compact('shared', 'intro'));
    }

    public function show(Coaching $coaching)
    {
        $file = URL::to('/').'/'.$coaching->file;
        $fileUrlSplited = explode("/", $coaching->file);
        $fileName = $fileUrlSplited[count($fileUrlSplited)-1];
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        readfile($file);

        return;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Coaching $coaching)
    {
        $this -> validate( $request, [
            'title' => 'Required|max:255|NotIn:php,ruby',
            'description' => 'Required|NotIn:php,ruby',
            'site' => 'Url|nullable',
            'file' => '',
        ] );
        // ******** Store data into DB ********
        $coaching -> title = $request -> title;
        $coaching -> description = $request -> description;
        $coaching -> user_id = \Auth::id();
        $coaching -> file = 'uploads/coaching/'.$request -> file;
        $coaching -> site = $request -> site;
        $coaching -> save();
        // ******** Upload file to server ********
        $file = $request->file;
        $fileUrlSplited = explode("/", $request->file);
        $fileName = $fileUrlSplited[count($fileUrlSplited)-1];
        Storage::disk('coaching')->put($fileName, $file);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coaching $coaching)
    {
        $coaching -> delete();

        return redirect() -> route( 'coaching' );
    }

     public function confirm(Coaching $coaching)
    {
        return view('coaching.confirm', compact('coaching'));
    }
}
