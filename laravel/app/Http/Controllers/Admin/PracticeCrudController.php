<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\PracticeRequest as StoreRequest;
use App\Http\Requests\PracticeRequest as UpdateRequest;

class PracticeCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Practice');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/practice');
        $this->crud->setEntityNameStrings('un entrainement', 'entrainements');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // ------ CRUD FIELDS
        $this->crud->addField(
            [
                'label' => "Jour",
                'name' => 'day',
                'type' => 'select_from_array',
                'options' => [null => '-', 'Lundi' => 'Lundi', 'Mardi' => 'Mardi', 'Mercredi' => 'Mercredi', 'Jeudi' => 'Jeudi', 'Vendredi' => 'Vendredi', 'Samedi' => 'Samedi', 'Dimanche' => 'Dimanche'],
                'allows_null' => false,
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label' => "Heure",
                'name' => 'time',
                'type' => 'time',
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label' => "Salle",
                'name' => 'location',
                'attributes' => [
                    'placeholder' => 'Grande Salle',
                 ],
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label'            => 'Équipe *',
                'type'             => 'select',
                'name'             => 'team_id', // the method that defines the relationship in your Model
                'entity'           => 'team', // the method that defines the relationship in your Model
                'attribute'        => 'divisionSeason', // foreign key attribute that is shown to user
                'model'            => "App\Models\Team", // foreign key model
            ],
            'both'
        );

        // ------ CRUD COLUMNS
        $this->crud->addColumns( [
            [
                'label' => 'Jour',
                'name' => 'day',
            ],
            [
                'label' => 'Heure',
                'name' => 'time',
                'type' => 'time',
            ],
            [
                'label' => 'Salle',
                'name' => 'location',
            ],
            [
                'label'     => 'Équipe', // Table column heading
                'type'      => 'select',
                'name'      => 'team_id', // the method that defines the relationship in your Model
                'entity'    => 'team', // the method that defines the relationship in your Model
                'attribute' => 'divisionSeason', // foreign key attribute that is shown to user
                'model'     => "App\Models\Team", // foreign key model
            ],
        ] );
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
