<?php

namespace App\Http\Controllers;

use DB;
use URL;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ******** Get the introduction ********
        $DB_intro = DB::table('downloadPage') -> select('value') -> where('key', 'intro') -> get();
        $intro = $DB_intro[0]->value;
        // ******** Get files list ********
        $files = Download::all();

        return view('download', compact( 'intro', 'files' ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Download $download)
    {
        $file = URL::to('/').$download->url;
        $fileUrlSplited = explode("/", $download->url);
        $fileName = $fileUrlSplited[count($fileUrlSplited)-1];
        header('Content-type: application/pdf');
        header('Content-Disposition: attachment; filename="'.$fileName.'"');
        readfile($file);

        return Redirect::route('telechargements');
    }
}