<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\UserCrudRequest as ShowRequest;
use App\Http\Requests\UserCrudRequest as StoreRequest;
use App\Http\Requests\UserCrudRequest as UpdateRequest;

class UserCrudController extends CrudController {

	public function setup() {
		 /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\User");
        $this->crud->setRoute("admin/user");
        $this->crud->setEntityNameStrings('user', 'users');

         /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        
        // $this->crud->setFromDb();

        // ------ CRUD FIELDS
		$this->crud->addFields([
			[   // Select form array
			    'name' => 'civility',
			    'label' => 'Titre',
			    'type' => 'select_from_array',
			    'options' => ['Mr.' => 'Monsieur', 'Mme.' => 'Madame', 'Mlle.' => 'Mademoiselle'],
			    'allows_null' => true,
			],
			[
			    'name' => 'name',
			    'label' => 'Nom',
			],
			[
				'name' => 'email',
				'label' => 'Adresse e-mail',
			],
			[   // Date
				'name' => 'birthday',
				'label' => 'Date de naissance',
				'type' => 'date',
			],
			[
				'name' => 'birth_location',
				'label' => 'Lieu de naissance',
			],
			[
				'name' => 'national_id',
				'label' => 'N° de registre national',
			],
			[
				'name' => 'address',
				'label' => 'Adresse',
			],
			[
				'name' => 'postal_code',
				'label' => 'Code postal',
			],
			[
				'name' => 'city',
				'label' => 'Ville',
			],
			[
				'name' => 'phone',
				'label' => 'Téléphone',
			],
			[
				'name' => 'jersey_nbr',
				'label' => 'N° de maillot',
			],
			[
		    	'label' => "Photo de profil",
			    'name' => "photo",
			    'type' => 'image',
			    'upload' => true,
			    'crop' => true, // set to true to allow cropping, false to disable
			    'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
			    // 'prefix' => 'uploads/images/profile_pictures/' // in case you only store the filename in the database, this text will be prepended to the database value
			],
			[
		        'label'            => 'Fait partie de la famille',
		        'type'             => 'select',
		        'name'             => 'family_id', // the method that defines the relationship in your Model
		        'entity'           => 'family', // the method that defines the relationship in your Model
		        'attribute'        => 'name', // foreign key attribute that is shown to user
		        'model'            => "App\Models\Family", // foreign key model
            ],
            [
		        'label'            => 'Fait partie des équipes',
		        'name'             => 'teams', // the method that defines the relationship in your Model
		        'type'              => 'checklist',
		        'entity'           => 'teams', // the method that defines the relationship in your Model
		        'attribute'        => 'division', // foreign key attribute that is shown to user
		        'model'            => "App\Models\Team", // foreign key model
		        'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
		        'number_columns'   => 4, //can be 1,2,3,4,6
            ],
			[
		        'label'            => 'Roles',
		        'name'             => 'roles', // the method that defines the relationship in your Model
		        'type'              => 'checklist',
		        'entity'           => 'roles', // the method that defines the relationship in your Model
		        'attribute'        => 'title', // foreign key attribute that is shown to user
		        'model'            => "App\Models\Role", // foreign key model
		        'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
		        'number_columns'   => 4, //can be 1,2,3,4,6
            ],
		]);

        // ------ CRUD COLUMNS
		// $this->crud->removeColumn('action');
        $this->crud->addColumns( [
        	[
        		'name' => 'civility',
        		'label' => 'Titre',
        	],
        	[
        		'name' => 'name',
        		'label' => 'Nom',
        	],
        	[
	           'label'     => 'Famille', // Table column heading
	           'type'      => 'select',
	           'name'      => 'family', // the method that defines the relationship in your Model
	           'entity'    => 'family', // the method that defines the relationship in your Model
	           'attribute' => 'name', // foreign key attribute that is shown to user
	           'model'     => "App\Models\Family", // foreign key model
	        ],
        	[ // n-n relationship (with pivot table)
	           'label'     => 'Roles', // Table column heading
	           'type'      => 'select_multiple',
	           'name'      => 'roles', // the method that defines the relationship in your Model
	           'entity'    => 'roles', // the method that defines the relationship in your Model
	           'attribute' => 'title', // foreign key attribute that is shown to user
	           'model'     => "App\Models\Roles", // foreign key model
	        ],
	        [
	           'label'     => 'Équipes', // Table column heading
	           'type'      => 'select_multiple',
	           'name'      => 'teams', // the method that defines the relationship in your Model
	           'entity'    => 'teams', // the method that defines the relationship in your Model
	           'attribute' => 'division', // foreign key attribute that is shown to user
	           'model'     => "App\Models\Team", // foreign key model
	        ],
	        [
        		'name' => 'jersey_nbr',
        		'label' => 'N° de maillot',
        	],
        	[
        		'name' => 'email',
        		'label' => 'Adresse e-mail',
        	],
        	[
        		'name' => 'phone',
        		'label' => 'Téléphone',
        	],
        	[
        		'name' => 'birthday',
        		'label' => 'Date de naissance',
        	],
        	[
        		'name' => 'birth_location',
        		'label' => 'Lieu de naissance',
        	],
        	[
        		'name' => 'national_id',
        		'label' => 'N° de registre national',
        	],
        	[
        		'name' => 'photo',
        		'label' => 'Photo de profil',
        	],
        	[
        		'name' => 'job',
        		'label' => 'Métier',
        	],
        	[
        		'name' => 'address',
        		'label' => 'Adresse',
        	],
        	[
        		'name' => 'postal_code',
        		'label' => 'Code postal',
        	],
        	[
        		'name' => 'city',
        		'label' => 'Ville',
        	],
        ] );
		
		// ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        $this->crud->enableExportButtons();
    }

    // ******** CRUD Functions ********

	public function store(StoreRequest $request)
	{
		return parent::storeCrud();
	}

	public function update(UpdateRequest $request)
	{
		return parent::updateCrud();
	}
}