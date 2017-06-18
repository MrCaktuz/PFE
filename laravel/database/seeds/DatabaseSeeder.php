<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); // disable foreign key constraints
        $this->call(FamiliesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(UsersTeamsTableSeeder::class);
        $this->call(CoachingTableSeeder::class);
        $this->call(GamesTableSeeder::class);

        $this->call(SettingsTableSeeder::class);
        $this->call(HomeTableSeeder::class);
        $this->call(ContactTableSeeder::class);
        $this->call(ComityTableSeeder::class);
        $this->call(ComplexeTableSeeder::class);
        $this->call(TrainerTableSeeder::class);
        $this->call(CoachingPageTableSeeder::class);
        $this->call(DownloadPageTableSeeder::class);
        $this->call(RulesTableSeeder::class);

   //      // ******** Roles ********
   //      DB::table('roles')->insert([
   //          'title' => 'Web Developer',
   //      ]);
   //      DB::table('roles')->insert([
   //          'title' => 'Web Communication',
   //      ]);
   //      DB::table('roles')->insert([
   //          'title' => 'Web Master',
   //      ]);
   //      DB::table('roles')->insert([
   //          'title' => 'Président',
   //      ]);
   //      DB::table('roles')->insert([
   //          'title' => 'Secrétaire',
   //      ]);
   //      DB::table('roles')->insert([
   //          'title' => 'Joueur',
   //      ]);
   //      DB::table('roles')->insert([
   //          'title' => 'Entraineur',
   //      ]);

   //      DB::table('roles')->insert([
   //          'title' => 'Trésorier',
   //      ]);

   //      // ******** Role_User ********
   //      DB::table('role_user')->insert([
   //      	// Balta -> entraineur
   //      	'user_id' => 2,
   //      	'role_id' => 7,
   //      ]);
   //      DB::table('role_user')->insert([
   //      	// Balta -> Joueur
   //      	'user_id' => 2,
   //      	'role_id' => 6,
   //      ]);
   //      DB::table('role_user')->insert([
   //      	// Pirlot -> Président
   //      	'user_id' => 5,
   //      	'role_id' => 4,
   //      ]);
   //      DB::table('role_user')->insert([
   //      	// Mathieu -> Joueur
   //      	'user_id' => 1,
   //      	'role_id' => 6,
   //      ]);
   //      DB::table('role_user')->insert([
   //      	// Mathieu -> Entraineur
   //      	'user_id' => 1,
   //      	'role_id' => 7,
   //      ]);
   //      DB::table('role_user')->insert([
   //      	// Mathieu -> Admin All
   //      	'user_id' => 1,
   //      	'role_id' => 1,
   //      ]);
   //      DB::table('role_user')->insert([
   //          // Pau -> Joueuse
   //          'user_id' => 4,
   //          'role_id' => 6,
   //      ]);
   //      DB::table('role_user')->insert([
   //          // Antoine -> Joueur
   //          'user_id' => 3,
   //          'role_id' => 6,
   //      ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1'); // enable foreign key constraints
    }
}
