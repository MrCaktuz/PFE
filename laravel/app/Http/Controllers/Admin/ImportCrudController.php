<?php

namespace App\Http\Controllers\Admin;

use DB;
use Input;
use Excel;
use Alert;
use Response;
use Validator;
use App\Models\Import;
use Backpack\CRUD\app\Http\Controllers\CrudController;

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
                'label' => 'Fichier CSV *',
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
        $fileMimeType = Input::file( 'import_file' )->getClientMimeType();
        if( Input::hasFile('import_file') && ( $fileMimeType == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || $fileMimeType == 'application/vnd.ms-excel' ) ) {
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if( !empty($data) && $data->count() ){
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
                if ( ( $insert[0]['team_id'] == NULL ) && ( $insert[0]['game_id'] == NULL ) && ( $insert[0]['date'] == NULL ) && ( $insert[0]['host'] == NULL ) && ( $insert[0]['visitor'] == NULL ) ) {
                    Alert::error("Le contenu du fichier n'étaient pas conforme.")->flash();
                    return redirect( 'admin/importExport' );
                } elseif ( !empty($insert) ){
                    DB::table('games')->insert($insert);
                    Alert::success("Les matches sont importé avec succès.")->flash();
                    return redirect('admin/game');
                } else{
                    Alert::error("Un problème est survenu lors de l'import des matchs. Veuillez réessayer.")->flash();
                    return redirect( 'admin/importExport' );
                }
            } else {
                Alert::error("Il n'y avait pas de données dans le fichier sélectionné.")->flash();
                return redirect( 'admin/importExport' );
            }
        } else {
            Alert::error("Vous devez importer un fichier Excel.")->flash();
            return redirect( 'admin/importExport' );
        }
        return back();
    }
}