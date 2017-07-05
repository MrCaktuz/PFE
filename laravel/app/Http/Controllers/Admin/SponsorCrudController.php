<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SponsorRequest as StoreRequest;
use App\Http\Requests\SponsorRequest as UpdateRequest;

class SponsorCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Sponsor');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/sponsor');
        $this->crud->setEntityNameStrings('un partenaire', 'partenaires');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // ------ CRUD FIELDS
        $this->crud->addField(
            [
                'label' => 'Nom du partenaire *',
                'name' => 'name',
                'attributes' => [
                    'placeholder' => 'Nike',
                 ],
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label' => 'URL du partenaire *',
                'name' => 'url',
                'attributes' => [
                    'placeholder' => 'http://www.nike.com',
                 ],
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label' => 'Logo du partenaire *',
                'type' => 'image',
                'name' => 'image',
                'upload' => true,
                'crop' => false, // set to true to allow cropping, false to disable
                'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
                // 'prefix' => 'uploads/images/profile_pictures/' // in case you only store the filename in the database, this text will be prepended to the database value
            ],
            'both'
        );

        // ------ CRUD COLUMNS
        $this->crud->addColumns( [
            [
                'label' => 'Partenaire',
                'name' => 'name',
            ],
            [
                'label' => 'URL',
                'name' => 'url',
            ],
            [
                'label' => 'logo',
                'name' => 'image',
            ],
        ] );

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
}
