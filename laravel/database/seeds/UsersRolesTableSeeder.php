<?php

use Illuminate\Database\Seeder;

class UsersRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_roles')->insert([
        	// Balta -> entraineur
        	'user_id' => 1,
        	'role_id' => 4,
        ]);
        DB::table('users_roles')->insert([
        	// Balta -> Joueur
        	'user_id' => 1,
        	'role_id' => 3,
        ]);
        DB::table('users_roles')->insert([
        	// Pirlot -> Président
        	'user_id' => 5,
        	'role_id' => 1,
        ]);
        DB::table('users_roles')->insert([
        	// Mathieu -> Joueur
        	'user_id' => 4,
        	'role_id' => 3,
        ]);
        DB::table('users_roles')->insert([
        	// Mathieu -> Entraineur
        	'user_id' => 4,
        	'role_id' => 4,
        ]);
        DB::table('users_roles')->insert([
        	// Mathieu -> web master
        	'user_id' => 4,
        	'role_id' => 6,
        ]);
    }
}
