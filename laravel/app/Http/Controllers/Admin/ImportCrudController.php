<?php

namespace App\Http\Controllers\Admin;

use DB;
use Input;
use Excel;
use Alert;
use App\Models\Import;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ImportRequest as ImportRequest;

class ImportCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Import');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/importExport');
        $this->crud->setEntityNameStrings('import', 'import');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->addfield(
            [
                'label' => 'Fichier CSV',
                'name' => 'file',
                'type' => 'upload',
                'upload' => true,
                'disk' => 'public_folder'
            ]
        );
    }
    public function importExport()
    {
        return view('backpack/importExport');
    }

    public function importExcel()
    {
        if(Input::hasFile('import_file')){
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = [
                        'team_id' => $value->team_id,
                        'game_id' => $value->game_id,
                        'date' => $value->date,
                        'day_id' => $value->day_id,
                        'time' => $value->time,
                        'appointment' => $value->appointment,
                        'host' => $value->host,
                        'visitor' => $value->visitor,
                        'location' => $value->location,
                        'score' => $value->score
                    ];
                }
                if(!empty($insert)){
                    DB::table('games')->insert($insert);
                    Alert::success("Les matches sont importé avec succès.")->flash();
                    return redirect()->to('admin/game');
                } else{
                    Alert::error("L'import n'as pas fonctionné. Vérifiez que vous avez soumis le bon fichier.")->flash();
                    return view('backpack/importExport');
                }
            } else {
                Alert::error("Le contenu du fichier n'as as été trouvé. Vérifiez que vous avez soumis le bon fichier.")->flash();
                return view('backpack/importExport');
            }
        }
        return back();
    }
}