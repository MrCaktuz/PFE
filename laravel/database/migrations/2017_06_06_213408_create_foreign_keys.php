<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('family_id')->references('id')->on('families')
						->onDelete('SET NULL')
						->onUpdate('SET NULL');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->foreign('role_id')->references('id')->on('roles')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('team_user', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('team_user', function(Blueprint $table) {
			$table->foreign('team_id')->references('id')->on('teams')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('photo_team', function(Blueprint $table) {
			$table->foreign('photo_id')->references('id')->on('photos')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('photo_team', function(Blueprint $table) {
			$table->foreign('team_id')->references('id')->on('teams')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('games', function(Blueprint $table) {
			$table->foreign('team_id')->references('id')->on('teams')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_family_id_foreign');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->dropForeign('role_user_user_id_foreign');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->dropForeign('role_user_role_id_foreign');
		});
		Schema::table('team_user', function(Blueprint $table) {
			$table->dropForeign('team_user_user_id_foreign');
		});
		Schema::table('team_user', function(Blueprint $table) {
			$table->dropForeign('team_user_team_id_foreign');
		});
		Schema::table('photo_team', function(Blueprint $table) {
			$table->dropForeign('photo_team_photo_id_foreign');
		});
		Schema::table('photo_team', function(Blueprint $table) {
			$table->dropForeign('photo_team_team_id_foreign');
		});
		Schema::table('games', function(Blueprint $table) {
			$table->dropForeign('games_team_id_foreign');
		});
	}
}