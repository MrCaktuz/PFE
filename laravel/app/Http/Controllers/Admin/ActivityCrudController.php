<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ActivityRequest as StoreRequest;
use App\Http\Requests\ActivityRequest as UpdateRequest;

class ActivityCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Activity');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/activity');
        $this->crud->setEntityNameStrings('une activité', 'activités');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // ------ CRUD FIELDS
        $this->crud->addField(
            [
                'label' => "Titre de l'activité",
                'name' => 'title',
                'attributes' => [
                    'placeholder' => 'Millitaria',
                 ],
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label' => "Date",
                'name' => 'date',
                'type' => 'date',
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label' => "Groupe de service",
                'name' => 'duty',
                'attributes' => [
                    'placeholder' => 'R1 Dames',
                 ],
            ],
            'both'
        );

        // ------ CRUD COLUMNS
        $this->crud->addColumns( [
            [
                'label' => 'Titre',
                'name' => 'title',
            ],
            [
                'label' => 'Date',
                'name' => 'date',
            ],
            [
                'label' => 'Service',
                'name' => 'duty',
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
