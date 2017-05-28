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
            'title' => 'AdminAll',
        ]);
        DB::table('roles')->insert([
            'title' => 'AdminPhoto',
        ]);
        DB::table('roles')->insert([
            'title' => 'Admin',
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
    }
}
