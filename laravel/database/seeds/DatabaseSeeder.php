<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ******** Famillies ********
        DB::table('families')->insert([
            'name' => 'Claessens Mathieu',
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);
        DB::table('families')->insert([
            'name' => 'Balthazar Yohan',
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);
        DB::table('families')->insert([
            'name' => 'Pirlot Jean-Luc',
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);

        // ******** Users ********
        DB::table('users')->insert([
            // user 1
            'civility' => 'Mr.',
            'name' => 'Claessens Mathieu',
            'birthday' => '1992-04-04',
            'birth_location' => 'Namur',
            'email' => 'mathieu_claessens@hotmail.com',
            'password' => bcrypt('password'),
            'phone' => '0476/524285',
            'national_id' => NULL,
            'photo' => '/uploads/profilPic.jpg',
            'job' => 'Web developpeur',
            'address' => 'Rue gailaipont, 23',
            'postal_code' => '5520',
            'city' => 'Onhaye',
            'family_id' => 1,
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);
        DB::table('users')->insert([
        	// user 2
            'civility' => 'Mr.',
            'name' => 'Balthazar Yohan',
            'birthday' => '1972-05-30',
            'birth_location' => '',
            'email' => 'yohan.balthazar@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0495/167788',
            'national_id' => NULL,
            'photo' => '',
            'job' => 'Médecin',
            'address' => 'Chaussée de namur, 73',
            'postal_code' => '5360',
            'city' => 'Natoye',
            'family_id' => 2,
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);

        DB::table('users')->insert([
        	// user 3
            'civility' => 'Mr.',
            'name' => 'Balthazar Antoine',
            'birthday' => '2000-09-08',
            'birth_location' => 'Namur',
            'email' => 'tonio.balthazar@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0491/122217',
            'national_id' => NULL,
            'photo' => '',
            'job' => 'Étudiant',
            'address' => 'Chaussée de namur, 73',
            'postal_code' => '5360',
            'city' => 'Natoye',
            'family_id' => 2,
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);

        DB::table('users')->insert([
			// user 4
            'civility' => 'Mlle.',
            'name' => 'Balthazar Pauline',
            'birthday' => '1998-12-16',
            'birth_location' => 'Namur',
            'email' => 'pauline.balthazar@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '0496/512311',
            'national_id' => NULL,
            'photo' => '',
            'job' => 'Étudiant',
            'address' => 'Chaussée de namur, 73',
            'postal_code' => '5360',
            'city' => 'Natoye',
            'family_id' => 2,
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);

        DB::table('users')->insert([
        	// user 5
            'civility' => 'Mr.',
            'name' => 'Pirlot Jean-Luc',
            'birthday' => '1963-08-24',
            'birth_location' => '',
            'email' => 'jean-luc.pirlot@skynet.be',
            'password' => bcrypt('password'),
            'phone' => '083/216555',
            'national_id' => NULL,
            'photo' => '',
            'job' => 'Médecin',
            'address' => 'Rue courtejoie, 53B',
            'postal_code' => '5590',
            'city' => 'Ciney',
            'family_id' => 3,
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);

        // ******** Roles ********
        DB::table('roles')->insert([
            'title' => 'Web Developer',
        ]);
        DB::table('roles')->insert([
            'title' => 'Web Communication',
        ]);
        DB::table('roles')->insert([
            'title' => 'Web Master',
        ]);
        DB::table('roles')->insert([
            'title' => 'Président',
        ]);
        DB::table('roles')->insert([
            'title' => 'Secrétaire',
        ]);
        DB::table('roles')->insert([
            'title' => 'Joueur',
        ]);
        DB::table('roles')->insert([
            'title' => 'Entraineur',
        ]);

        DB::table('roles')->insert([
            'title' => 'Trésorier',
        ]);

        // ******** Role_User ********
        DB::table('role_user')->insert([
        	// Balta -> entraineur
        	'user_id' => 2,
        	'role_id' => 7,
        ]);
        DB::table('role_user')->insert([
        	// Balta -> Joueur
        	'user_id' => 2,
        	'role_id' => 6,
        ]);
        DB::table('role_user')->insert([
        	// Pirlot -> Président
        	'user_id' => 5,
        	'role_id' => 4,
        ]);
        DB::table('role_user')->insert([
        	// Mathieu -> Joueur
        	'user_id' => 1,
        	'role_id' => 6,
        ]);
        DB::table('role_user')->insert([
        	// Mathieu -> Entraineur
        	'user_id' => 1,
        	'role_id' => 7,
        ]);
        DB::table('role_user')->insert([
        	// Mathieu -> Admin All
        	'user_id' => 1,
        	'role_id' => 1,
        ]);
        DB::table('role_user')->insert([
            // Pau -> Joueuse
            'user_id' => 4,
            'role_id' => 6,
        ]);
        DB::table('role_user')->insert([
            // Antoine -> Joueur
            'user_id' => 3,
            'role_id' => 6,
        ]);
    }
}
