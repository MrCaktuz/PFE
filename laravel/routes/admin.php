<?php

	// Backpack\CRUD: Define the resources for the entities you want to CRUD.
	CRUD::resource('user', 'UserCrudController');
	CRUD::resource('family', 'FamilyCrudController');
	CRUD::resource('role', 'RoleCrudController');
	CRUD::resource('event', 'EventCrudController');
	CRUD::resource('download', 'DownloadCrudController');
	CRUD::resource('team', 'TeamCrudController');
<<<<<<< HEAD
	CRUD::resource('sponsor', 'SponsorCrudController');
	CRUD::resource('coaching', 'CoachingCrudController');
=======
>>>>>>> fc5e39cc87640efd7080f0635c51abdedeba7533
	
	CRUD::resource('setting', 'SettingCrudController');
	CRUD::resource('rule', 'RuleCrudController');
	CRUD::resource('home', 'HomeCrudController');
	CRUD::resource('complexe', 'ComplexeCrudController');
	CRUD::resource('contact', 'ContactCrudController');
	CRUD::resource('comity', 'ComityCrudController');
	CRUD::resource('trainer', 'TrainerCrudController');
	CRUD::resource('downloadpage', 'DownloadPageCrudController');
	CRUD::resource('coachingpage', 'CoachingPageCrudController');
