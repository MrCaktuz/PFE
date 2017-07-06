<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AlbumCreateRequest as StoreRequest;
use App\Http\Requests\AlbumUpdateRequest as UpdateRequest;

class AlbumCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Album');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/album');
        $this->crud->setEntityNameStrings('un album', 'albums');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // ------ CRUD FIELDS
        $this->crud->addField(
            [
                'label' => "Nom de l'album *",
                'name' => 'name',
                'attributes' => [
                    'placeholder' => 'Présentation des équipes 2017',
                 ],
            ],
            'both'
        );
        $this->crud->addField(
            [
               'label'            => 'Équipe liés à l\'album',
                'type'             => 'select2_multiple',
                'name'             => 'teams', // the method that defines the relationship in your Model
                'entity'           => 'teams', // the method that defines the relationship in your Model
                'attribute'        => 'division', // foreign key attribute that is shown to user
                'model'            => 'App\Models\Team', // foreign key model
                'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label' => 'Photos * (en format jpg, jpeg ou png)',
                'name' => 'photos',
                'type' => 'upload_multiple',
                'upload' => true,
                'disk' => 'public_folder' // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
            ],
            'create'
        );

        // ------ CRUD COLUMNS
        $this->crud->addColumns( [
            [
                'label' => 'Nom',
                'name' => 'name',
            ],
            [
               'label'     => 'Équipes lié à l\'album', // Table column heading
               'type'      => 'select_multiple',
               'name'      => 'teams', // the method that defines the relationship in your Model
               'entity'    => 'teams', // the method that defines the relationship in your Model
               'attribute' => 'division', // foreign key attribute that is shown to user
               'model'     => "App\Models\Album", // foreign key model
            ],
        ] );

        // ------ CRUD BUTTONS
        $this->crud->addButtonFromModelFunction('line', 'Aperçu', 'showAlbumButton', 'end');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        // var_dump( $request -> photos );
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // var_dump( $request -> photos );
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
