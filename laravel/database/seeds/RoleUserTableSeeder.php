<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
