<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\RoleCreateRequest as StoreRequest;
use App\Http\Requests\RoleUpdateRequest as UpdateRequest;

class RoleCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Role');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/role');
        $this->crud->setEntityNameStrings('un role', 'roles');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // ------ CRUD FIELDS
        $this->crud->addField(
            [
                'label' => 'Titre *',
                'name' => 'title',
                'attributes' => [
                    'placeholder' => 'Joueur',
                 ],
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label'            => 'Membres',
                'type'             => 'select2_multiple',
                'name'             => 'users', // the method that defines the relationship in your Model
                'entity'           => 'users', // the method that defines the relationship in your Model
                'attribute'        => 'name', // foreign key attribute that is shown to user
                'model'            => 'App\User', // foreign key model
                'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
            ],
            'both'
        );

        // ------ CRUD COLUMNS
        $this->crud->addColumns( [
            [
                'label' => 'Titre',
                'name' => 'title',
            ],
            [ // n-n relationship (with pivot table)
               'label'     => 'Membres', // Table column heading
               'type'      => 'select_multiple',
               'name'      => 'users', // the method that defines the relationship in your Model
               'entity'    => 'users', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model'     => "App\User", // foreign key model
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
