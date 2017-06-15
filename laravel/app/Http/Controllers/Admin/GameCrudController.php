<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\GameRequest as StoreRequest;
use App\Http\Requests\GameRequest as UpdateRequest;
use App\Http\Requests\GameRequest as UploadRequest;

class GameCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Game');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/game');
        $this->crud->setEntityNameStrings('game', 'games');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // ------ CRUD FIELDS
        $this->crud->addFields([
            [
                'label'            => 'Équipe',
                'type'             => 'select',
                'name'             => 'team_id', // the method that defines the relationship in your Model
                'entity'           => 'team', // the method that defines the relationship in your Model
                'attribute'        => 'division', // foreign key attribute that is shown to user
                'model'            => "App\Models\Team", // foreign key model
            ],
            [
                'label' => 'N° du match',
                'name' => 'game_id',
            ],
            [
                'label' => 'Date du match',
                'name' => 'date',
                'type' => 'date',
            ],
            [
                'label' => 'Heure du match',
                'name' => 'time',
                'type' => 'time',
            ],
            [
                'label' => 'Heure de rendez-vous',
                'name' => 'appointment',
                'type' => 'time',
            ],
            [
                'label' => 'Visité',
                'name' => 'host',
            ],
            [
                'label' => 'Visiteur',
                'name' => 'visitor',
            ],
            [
                'label' => 'Score final',
                'name' => 'score',
            ],
            [
                'label' => 'Service',
                'name' => 'duty',
            ],
            [
                'label' => 'N° de journée',
                'name' => 'day_id',
            ],
            [
                'label' => 'Lieu du match',
                'name' => 'location',
            ],
        ]);

        // ------ CRUD COLUMNS
        $this->crud->addColumns( [
            [
                'label'     => 'Équipe', // Table column heading
                'type'      => 'select',
                'name'      => 'team_id', // the method that defines the relationship in your Model
                'entity'    => 'team', // the method that defines the relationship in your Model
                'attribute' => 'division', // foreign key attribute that is shown to user
                'model'     => "App\Models\Team", // foreign key model
            ],
            [
                'label' => 'N° du match',
                'name' => 'game_id',
            ],
            [
                'label' => 'Date du match',
                'name' => 'date',
                'type' => 'date',
            ],
            [
                'label' => 'Heure du match',
                'name' => 'time',
                'type' => 'time',
            ],
            [
                'label' => 'Heure de rendez-vous',
                'name' => 'appointment',
                'type' => 'time',
            ],
            [
                'label' => 'Visité',
                'name' => 'host',
            ],
            [
                'label' => 'Visiteur',
                'name' => 'visitor',
            ],
            [
                'label' => 'Score final',
                'name' => 'score',
            ],
            [
                'label' => 'Service',
                'name' => 'duty',
            ],
            [
                'label' => 'N° de journée',
                'name' => 'day_id',
            ],
            [
                'label' => 'Lieu du match',
                'name' => 'location',
            ],
        ] );

        // ------ CRUD BUTTONS
        $this->crud->addButtonFromView('top', 'upload', 'uploads', 'end'); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        $this->crud->enableExportButtons();
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

    public function upload(UploadRequest $request)
    {
        // get the info for that entry
        // $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;
        $this->data['title'] = 'Ajouter depuis un fichier';
        $this->view = 'upload';

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->view, $this->data);
    }
}
