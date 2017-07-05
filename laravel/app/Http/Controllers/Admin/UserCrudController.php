<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\UserCreateRequest as StoreRequest;
use App\Http\Requests\UserUpdateRequest as UpdateRequest;

class UserCrudController extends CrudController {

	public function setup() {
		 /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel("App\User");
        $this->crud->setRoute("admin/user");
        $this->crud->setEntityNameStrings('membre', 'Membres');

         /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        
        // $this->crud->setFromDb();

        // ------ CRUD FIELDS
		$this->crud->addField(
			[   // Select form array
			    'label' => 'Titre',
			    'name' => 'civility',
			    'attributes' => [
			    	'placeholder' => 'Monsieur, Madame, Mademoiselle',
			     ],
			],
			'both'
		);
		$this->crud->addField(
			[
			    'label' => 'Nom *',
			    'name' => 'name',
			    'attributes' => [
			    	'placeholder' => 'Pirlot Jean-Luc',
			     ],
			],
			'both'
		);
		$this->crud->addField(
			[
				'label' => 'Adresse e-mail *',
				'name' => 'email',
				'attributes' => [
			    	'placeholder' => 'exemple@rbcciney.be',
			     ],
			],
			'both'
		);
		$this->crud->addField(
			[
				'label' => 'Mot de passe *',
				'type' => 'password',
				'name' => 'password',
			],
			'create'
		);
		$this->crud->addField(
			[
				'label' => 'Confirmation du mot de passe *',
				'type' => 'password',
				'name' => 'password_confirmation',
			],
			'create'
		);
		$this->crud->addField(
			[   // Date
				'label' => 'Date de naissance',
				'type' => 'date',
				'name' => 'birthday',
			],
			'both'
		);
		$this->crud->addField(
			[
				'label' => 'Lieu de naissance',
				'name' => 'birth_location',
				'attributes' => [
			    	'placeholder' => 'Namur',
			     ],
			],
			'both'
		);
		$this->crud->addField(
			[
				'label' => 'N° de registre national',
				'name' => 'national_id',
				'attributes' => [
			    	'placeholder' => '00.00.00-000-00',
			     ],
			],
			'both'
		);
		$this->crud->addField(
			[
				'label' => 'Adresse',
				'name' => 'address',
				'attributes' => [
			    	'placeholder' => 'Rue Saint-Quentin, 10b',
			     ],
			],
			'both'
		);
		$this->crud->addField(
			[
				'label' => 'Code postal',
				'name' => 'postal_code',
				'attributes' => [
			    	'placeholder' => '5590',
			     ],
			],
			'both'
		);
		$this->crud->addField(
			[
				'label' => 'Ville',
				'name' => 'city',
				'attributes' => [
			    	'placeholder' => 'Ciney',
			     ],
			],
			'both'
		);
		$this->crud->addField(
			[
				'label' => 'Téléphone',
				'name' => 'phone',
				'attributes' => [
			    	'placeholder' => '0495214550',
			     ],
			],
			'both'
		);
		$this->crud->addField(
			[
				'label' => 'N° de maillot',
				'name' => 'jersey_nbr',
			    'default' => '0',
			],
			'both'
		);
		$this->crud->addField(
			[
		    	'label' => "Photo de profil",
			    'type' => 'image',
			    'name' => "photo",
			    'upload' => true,
			    'crop' => true, // set to true to allow cropping, false to disable
			    'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
			    // 'prefix' => 'uploads/images/profile_pictures/' // in case you only store the filename in the database, this text will be prepended to the database value
			],
			'both'
		);
		$this->crud->addField(
			[
		        'label'            => 'Fait partie de la famille *',
		        'type'             => 'select',
		        'name'             => 'family_id', // the method that defines the relationship in your Model
		        'entity'           => 'family', // the method that defines the relationship in your Model
		        'attribute'        => 'name', // foreign key attribute that is shown to user
		        'model'            => "App\Models\Family", // foreign key model
            ],
			'both'
		);
		$this->crud->addField(
            [
		        'label'            => 'Fait partie des équipes',
		        'type'              => 'select2_multiple',
		        'name'             => 'teams', // the method that defines the relationship in your Model
		        'entity'           => 'teams', // the method that defines the relationship in your Model
		        'attribute'        => 'division', // foreign key attribute that is shown to user
		        'model'            => "App\Models\Team", // foreign key model
		        'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
            ],
			'both'
		);
		$this->crud->addField(
			[
		        'label'            => 'Roles',
		        'type'              => 'checklist',
		        'name'             => 'roles', // the method that defines the relationship in your Model
		        'entity'           => 'roles', // the method that defines the relationship in your Model
		        'attribute'        => 'title', // foreign key attribute that is shown to user
		        'model'            => "App\Models\Role", // foreign key model
		        'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
		        'number_columns'   => 4, //can be 1,2,3,4,6
            ],
			'both'
		);

        // ------ CRUD COLUMNS
		// $this->crud->removeColumn('action');
        $this->crud->addColumn(
        	[
        		'label' => 'Titre',
        		'name' => 'civility',
        	],
        	'both'
        );
        $this->crud->addColumn(
        	[
        		'name' => 'name',
        		'label' => 'Nom',
        	],
        	'both'
        );
        $this->crud->addColumn(
        	[
	           'label'     => 'Famille', // Table column heading
	           'type'      => 'select',
	           'name'      => 'family', // the method that defines the relationship in your Model
	           'entity'    => 'family', // the method that defines the relationship in your Model
	           'attribute' => 'name', // foreign key attribute that is shown to user
	           'model'     => "App\Models\Family", // foreign key model
	        ],
        	'both'
        );
        $this->crud->addColumn(
        	[ // n-n relationship (with pivot table)
	           'label'     => 'Roles', // Table column heading
	           'type'      => 'select_multiple',
	           'name'      => 'roles', // the method that defines the relationship in your Model
	           'entity'    => 'roles', // the method that defines the relationship in your Model
	           'attribute' => 'title', // foreign key attribute that is shown to user
	           'model'     => "App\Models\Roles", // foreign key model
	        ],
        	'both'
        );
        $this->crud->addColumn(
	        [
	           'label'     => 'Équipes', // Table column heading
	           'type'      => 'select_multiple',
	           'name'      => 'teams', // the method that defines the relationship in your Model
	           'entity'    => 'teams', // the method that defines the relationship in your Model
	           'attribute' => 'division', // foreign key attribute that is shown to user
	           'model'     => "App\Models\Team", // foreign key model
	        ],
        	'both'
        );
        $this->crud->addColumn(
	        [
        		'label' => 'N° de maillot',
        		'name' => 'jersey_nbr',
        	],
        	'both'
        );
        $this->crud->addColumn(
        	[
        		'label' => 'Adresse e-mail',
        		'name' => 'email',
        	],
        	'both'
        );
        $this->crud->addColumn(
        	[
        		'label' => 'Téléphone',
        		'name' => 'phone',
        	],
        	'both'
        );
        $this->crud->addColumn(
        	[
        		'label' => 'Date de naissance',
        		'name' => 'birthday',
        	],
        	'both'
        );
        $this->crud->addColumn(
        	[
        		'label' => 'Lieu de naissance',
        		'name' => 'birth_location',
        	],
        	'both'
        );
        $this->crud->addColumn(
        	[
        		'label' => 'N° de registre national',
        		'name' => 'national_id',
        	],
        	'both'
        );
        $this->crud->addColumn(
        	[
        		'label' => 'Photo de profil',
        		'name' => 'photo',
        	],
        	'both'
        );
        $this->crud->addColumn(
        	[
        		'label' => 'Métier',
        		'name' => 'job',
        	],
        	'both'
        );
        $this->crud->addColumn(
        	[
        		'label' => 'Adresse',
        		'name' => 'address',
        	],
        	'both'
        );
        $this->crud->addColumn(
        	[
        		'label' => 'Code postal',
        		'name' => 'postal_code',
        	],
        	'both'
        );
        $this->crud->addColumn(
        	[
        		'label' => 'Ville',
        		'name' => 'city',
        	],
        	'both'
        );
		
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