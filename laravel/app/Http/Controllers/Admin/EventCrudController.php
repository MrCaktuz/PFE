<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\EventRequest as StoreRequest;
use App\Http\Requests\EventRequest as UpdateRequest;

class EventCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Event');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/event');
        $this->crud->setEntityNameStrings('event', 'events');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        // ------ CRUD FIELDS
        $this->crud->addField(
            [   // Select form array
                'label' => 'Titre',
                'name' => 'title',
            ],
            'both'
        );
        $this->crud->addField(
            [   // CKEditor
                'label' => 'Description *',
                'type' => 'ckeditor',
                'name' => 'description',
                // optional:
                // 'extra_plugins' => ['oembed', 'widget', 'justify']
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label' => "Photo de l'événement",
                'type' => 'image',
                'name' => "photo",
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
                'label' => "Titre de l'événement",
                'name' => 'title',
            ],
            [
                'label' => "Description de l'événement",
                'name' => 'description',
            ],
            [
                'label' => "Photo de l'événement",
                'name' => 'photo',
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
