<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\DownloadRequest as StoreRequest;
use App\Http\Requests\DownloadRequest as UpdateRequest;

class DownloadCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Download');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/download');
        $this->crud->setEntityNameStrings('download', 'downloads');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // ------ CRUD FIELDS
        $this->crud->addField(
            [
                'label' => 'Titre du document *',
                'name' => 'title',
                'attributes' => [
                    'placeholder' => "Déclaration d'accident 2017 - 2018",
                 ],
            ],
            'both'
        );
        $this->crud->addField(
            [   // Browse
                'label' => 'Fichier à télécharger *',
                'name' => 'url',
                'type' => 'browse'
            ],
            'both'
        );

        // ------ CRUD COLUMNS
        $this->crud->addColumns( [
            [
                'label' => 'Fichiers',
                'name' => 'title',
            ],
            [
                'label' => 'Liens',
                'name' => 'url',
            ],
        ] );

        // ------ CRUD BUTTONS
        $this->crud->addButtonFromModelFunction('line', 'Aperçu', 'getShowButton', 'beginning');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
