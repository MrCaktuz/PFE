<?php

namespace App\Http\Controllers\Admin;

use DB;
use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TeamRequest as StoreRequest;
use App\Http\Requests\TeamRequest as UpdateRequest;

class TeamCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Team');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/team');
        $this->crud->setEntityNameStrings('une équipe', 'équipes');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // $this->crud->setFromDb();

        // ------ CRUD FIELDS
        $this->crud->addField(
            [
                'label' => 'Nom de l\'équipe *',
                'name' => 'division',
                'attributes' => [
                    'placeholder' => 'P1 Hommes',
                 ],
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label' => 'Saison *',
                'name' => 'season',
                'attributes' => [
                    'placeholder' => '2017 - 2018',
                 ],
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label'            => 'Entraineur *',
                'type'             => 'select',
                'name'             => 'coach_id', // the method that defines the relationship in your Model
                'entity'           => 'coach', // the method that defines the relationship in your Model
                'attribute'        => 'name', // foreign key attribute that is shown to user
                'model'            => "App\User", // foreign key model
                // 'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label'            => 'Assistant',
                'type'             => 'select',
                'name'             => 'assistant_id', // the method that defines the relationship in your Model
                'entity'           => 'assistant', // the method that defines the relationship in your Model
                'attribute'        => 'name', // foreign key attribute that is shown to user
                'model'            => "App\User", // foreign key model
                // 'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label'            => 'Joueurs *',
                'type'             => 'select2_multiple',
                'name'             => 'users', // the method that defines the relationship in your Model
                'entity'           => 'users', // the method that defines the relationship in your Model
                'attribute'        => 'name', // foreign key attribute that is shown to user
                'model'            => 'App\User', // foreign key model
                'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
            ],
            'both'
        );
        $this->crud->addField(
            [
                'label' => "Photo d'équipe",
                'name' => "photo",
                'type' => 'image',
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
                'label' => 'ID',
                'name' => 'id',
            ],
            [
                'label' => 'Saison',
                'name' => 'season',
            ],
            [
                'label' => 'Équipe',
                'name' => 'division',
            ],
            [
               'label'     => 'Entraineur', // Table column heading
               'type'      => 'select',
               'name'      => 'coach_id', // the method that defines the relationship in your Model
               'entity'    => 'coach', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model'     => "App\User", // foreign key model
            ],
            [
               'label'     => 'Assistant', // Table column heading
               'type'      => 'select',
               'name'      => 'assistant_id', // the method that defines the relationship in your Model
               'entity'    => 'assistant', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model'     => "App\User", // foreign key model
            ],
            [ // n-n relationship (with pivot table)
               'label'     => 'Joueurs', // Table column heading
               'type'      => 'select_multiple',
               'name'      => 'users', // the method that defines the relationship in your Model
               'entity'    => 'users', // the method that defines the relationship in your Model
               'attribute' => 'name', // foreign key attribute that is shown to user
               'model'     => "App\User", // foreign key model
            ],
            [
                'label' => 'Photo',
                'name' => 'photo',
            ],
        ] );
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud();
        // your additional operations after save here
        // 1. Get the team name & season
        $teamName = $request -> division;
        $teamSeason = $request -> season;
        // 2. Get the ID of the coach selected
        $coachID = $request -> coach_id;
        // 3. Get the ID of the Assistant selected
        $assistantID = $request -> assistant_id;
        // 4. Update data
        DB::Table( 'teams' ) -> where( 'division', $teamName ) -> where( 'season', $teamSeason ) -> update( [ 'coach_id' => $coachID, 'assistant_id' => $assistantID ] );
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // 1. Get the team ID
        $teamID = $request -> id;
        // 2. Get the ID of the coach selected
        $newCoachID = $request -> coach_id;
        // 3. Get the ID of the Assistant selected
        $newAssistantID = $request -> assistant_id;
        // 4. Update data
        DB::Table( 'teams' ) -> where( 'id', $teamID ) -> update( [ 'coach_id' => $newCoachID, 'assistant_id' => $newAssistantID ] );
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
