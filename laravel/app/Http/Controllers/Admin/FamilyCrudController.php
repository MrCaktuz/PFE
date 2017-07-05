<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\User;
use Carbon\Carbon;
use App\Models\Family;
use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use Illuminate\Http\Request;
use App\Http\Requests\FamilyCreateCrudRequest as StoreRequest;
use App\Http\Requests\FamilyUpdateCrudRequest as UpdateRequest;

class FamilyCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Family');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/family');
        $this->crud->setEntityNameStrings('family', 'families');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // $this->crud->setFromDb();

        // ------ CRUD FIELDS
        $this->crud->addField(
            [
                'label' => 'Nom de la famille *',
                'name' => 'name',
                'attributes' => [
                    'placeholder' => 'Pirlot Jean-Luc',
                 ],
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label'            => 'Membre de la famille',
                'type'             => 'select2_multiple',
                'name'             => 'users', // the method that defines the relationship in your Model
                'entity'           => 'users', // the method that defines the relationship in your Model
                'attribute'        => 'name', // foreign key attribute that is shown to user
                'model'            => 'App\User', // foreign key model
            ],
            'both'
        );

        // ------ CRUD COLUMNS
        $this->crud->addColumns( [
            [
                'label' => 'Famille',
                'name' => 'name',
            ],
            [
               'label'     => 'Membres de la famille', // Table column heading
               'type'      => 'select_multiple',
               'name'      => 'users', // the method that defines the relationship in your Model
               'entity'    => 'users', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model'     => "App\Models\Family", // foreign key model
            ],
        ] );

        // ------ CRUD BUTTONS
        $this->crud->addButtonFromModelFunction('line', 'Email', 'getSendMailButton', 'beginning');

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        $this->crud->enableExportButtons();

    }

    public function store( StoreRequest $request, Family $family )
    {
        // 1. Save Family name
        $redirect_location = parent::storeCrud();
        // 2. Get the ID of the new family
        $id = DB::getPdo()->lastInsertId();
        // 3. Update family_id of selected users
        if ( $request -> users ) {
            foreach ($request -> users as $userSelected ) {
                DB::Table( 'users' ) -> where( 'id', $userSelected ) -> update( [ 'family_id' => $id ] );
            }
        }
        // 4. Redirection
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        // 1. Save Updates
        $redirect_location = parent::updateCrud();
        // 2. Get the ID of the new family
        $id = $request -> id;
        // 3. Remove family_id from unselected users
        DB::Table( 'users' ) -> where( 'family_id', $id ) -> update( [ 'family_id' => NULL ] );
        // 4. Set family_id for selected users
        if ( $request -> users ) {
            foreach ($request -> users as $userSelected ) {
                DB::Table( 'users' ) -> where( 'id', $userSelected ) -> update( [ 'family_id' => $id ] );
            }
        }
        // 5. Rediection
        return $redirect_location;
    }
}
