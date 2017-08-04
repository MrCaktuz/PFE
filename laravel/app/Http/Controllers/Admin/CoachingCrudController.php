<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CoachingRequest as StoreRequest;
use App\Http\Requests\CoachingRequest as UpdateRequest;

class CoachingCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Coaching');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/coaching');
        $this->crud->setEntityNameStrings('coaching', 'coaching');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // ------ CRUD FIELDS
        $this->crud->addFields( [
            [
                'label' => 'Titre *',
                'name' => 'title',
                'attributes' => [
                    'placeholder' => "Fiche de préparation d'entrainements",
                 ],
            ],
            [
                'label' => 'Description *',
                'name' => 'description',
                'attributes' => [
                    'placeholder' => 'Un petit text descriptif',
                 ],
            ],
            [
                'label'            => 'Auteur',
                'type'             => 'select',
                'name'             => 'user_id', // the method that defines the relationship in your Model
                'entity'           => 'user', // the method that defines the relationship in your Model
                'attribute'        => 'name', // foreign key attribute that is shown to user
                'model'            => "App\User", // foreign key model
            ],
            [
                'label' => 'Site partagé',
                'name' => 'site',
                'attributes' => [
                    'placeholder' => 'http://exemple.be',
                 ],
            ],
            [
                'label' => 'Fichier partagé',
                'name' => 'file',
                'type' => 'browse',
            ],
        ] );

        // ------ CRUD COLUMNS
        $this->crud->addColumns( [
            [
                'label' => 'Titre',
                'name' => 'title',
            ],
            [
                'label' => 'Description',
                'name' => 'description',
            ],
            [
                'label' => 'Auteur',
                'type'      => 'select',
                'name'      => 'user', // the method that defines the relationship in your Model
                'entity'    => 'user', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => "App\User", // foreign key model
            ],
            [
                'label' => 'Site partagé',
                'name' => 'site',
            ],
            [
                'label' => 'Fichier partagé',
                'name' => 'file',
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
