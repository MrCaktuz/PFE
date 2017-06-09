<?php

	// Backpack\CRUD: Define the resources for the entities you want to CRUD.
	CRUD::resource('user', 'UserCrudController');
	CRUD::resource('family', 'FamilyCrudController');
	CRUD::resource('role', 'RoleCrudController');
	CRUD::resource('event', 'EventCrudController');
	CRUD::resource('team', 'TeamCrudController');