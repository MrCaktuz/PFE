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
        $this->crud->setEntityNameStrings('team', 'teams');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        // $this->crud->setFromDb();

        // ------ CRUD FIELDS
        $this->crud->addFields([
            [
                'label' => 'Nom de l\'équipe *',
                'name' => 'division',
            ],
            [
                'label' => 'Saison *',
                'name' => 'season',
            ],
            [
                'label'            => 'Entraineur *',
                'type'             => 'select',
                'name'             => 'coach_id', // the method that defines the relationship in your Model
                'entity'           => 'coach', // the method that defines the relationship in your Model
                'attribute'        => 'name', // foreign key attribute that is shown to user
                'model'            => "App\User", // foreign key model
                // 'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
            ],
            [
                'label'            => 'Assistant',
                'type'             => 'select',
                'name'             => 'assistant_id', // the method that defines the relationship in your Model
                'entity'           => 'assistant', // the method that defines the relationship in your Model
                'attribute'        => 'name', // foreign key attribute that is shown to user
                'model'            => "App\User", // foreign key model
                // 'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
            ],
            [
                'label'            => 'Joueurs',
                'type'             => 'select2_multiple',
                'name'             => 'users', // the method that defines the relationship in your Model
                'entity'           => 'users', // the method that defines the relationship in your Model
                'attribute'        => 'name', // foreign key attribute that is shown to user
                'model'            => 'App\User', // foreign key model
                'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
            ],
            [   // Browse
                'name' => 'photo',
                'label' => 'Photo de profil',
                'type' => 'browse'
            ],
        ]);
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        $this->crud->addColumns( [
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
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
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
