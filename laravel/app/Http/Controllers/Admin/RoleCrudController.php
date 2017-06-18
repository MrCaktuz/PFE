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
        $this->crud->setEntityNameStrings('role', 'roles');

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
            ],
            'both',
        );

        // ------ CRUD COLUMNS
        $this->crud->addColumn(
            [
                'label' => 'Titre',
                'name' => 'title',
            ],
        );
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
