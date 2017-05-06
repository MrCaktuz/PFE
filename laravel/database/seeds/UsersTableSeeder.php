<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	// user 1
        	'id' => 1,
            'civility' => 'Monsieur',
            'first_name' => 'Yohan',
            'last_name' => 'Balthazar',
            'birth_date' => '1972-05-30',
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
            'family_name' => 'Yohan Balthazar',
            'family_chef' => 1,
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);

        DB::table('users')->insert([
        	// user 2
            'id' => 2,
            'civility' => 'Monsieur',
            'first_name' => 'Antoine',
            'last_name' => 'Balthazar',
            'birth_date' => '2000-09-08',
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
            'family_name' => 'Yohan Balthazar',
            'family_chef' => 0,
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);

        DB::table('users')->insert([
			// user 3
            'id' => 3,
            'civility' => 'Madame',
            'first_name' => 'Pauline',
            'last_name' => 'Balthazar',
            'birth_date' => '1998-12-16',
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
            'family_name' => 'Yohan Balthazar',
            'family_chef' => 0,
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);

        DB::table('users')->insert([
        	// user 4
            'id' => 4,
            'civility' => 'Monsieur',
            'first_name' => 'Mathieu',
            'last_name' => 'Claessens',
            'birth_date' => '1992-04-04',
            'birth_location' => 'Namur',
            'email' => 'mathieu_claessens@hotmail.com',
            'password' => bcrypt('password'),
            'phone' => '0476/524285',
            'national_id' => NULL,
            'photo' => '',
            'job' => 'Web developpeur',
            'address' => 'Rue gailaipont, 23',
            'postal_code' => '5520',
            'city' => 'Onhaye',
            'family_name' => 'Mathieu Claessens',
            'family_chef' => 1,
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);

        DB::table('users')->insert([
        	// user 5
            'id' => 5,
            'civility' => 'Monsieur',
            'first_name' => 'Jean-Luc',
            'last_name' => 'Pirlot',
            'birth_date' => '1963-08-24',
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
            'family_name' => 'Jean-Luc Pirlot',
            'family_chef' => 1,
            'created_at' => date_create(),
            'updated_at' => date_create(),
        ]);
    }
}
