<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            // Role 1
            'id' => 1,
            'title' => 'Président',
        ]);

        DB::table('roles')->insert([
            // Role 2
            'id' => 2,
            'title' => 'Secrétaire',
        ]);

        DB::table('roles')->insert([
            // Role 3
            'id' => 3,
            'title' => 'Joueur',
        ]);

        DB::table('roles')->insert([
            // Role 4
            'id' => 4,
            'title' => 'Entraineur',
        ]);

        DB::table('roles')->insert([
            // Role 5
            'id' => 5,
            'title' => 'Trésorier',
        ]);
        DB::table('roles')->insert([
            // Role 6
            'id' => 6,
            'title' => 'Web master',
        ]);
    }
}
