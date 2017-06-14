<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->foreign('family_id')->references('id')->on('families')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('role_user', function(Blueprint $table) {
			$table->foreign('role_id')->references('id')->on('roles')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('teams', function(Blueprint $table) {
			$table->foreign('coach_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('teams', function(Blueprint $table) {
			$table->foreign('assistant_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('team_user', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('team_user', function(Blueprint $table) {
			$table->foreign('team_id')->references('id')->on('teams')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('album_team', function(Blueprint $table) {
			$table->foreign('album_id')->references('id')->on('albums')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('album_team', function(Blueprint $table) {
			$table->foreign('team_id')->references('id')->on('teams')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('games', function(Blueprint $table) {
			$table->foreign('team_id')->references('id')->on('teams')
						->onDelete('set null')
						->onUpdate('set null');
		});
		Schema::table('coaching', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('set null')
						->onUpdate('set null');
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
		Schema::table('teams', function(Blueprint $table) {
			$table->dropForeign('teams_coach_id_foreign');
		});
		Schema::table('teams', function(Blueprint $table) {
			$table->dropForeign('teams_assistant_id_foreign');
		});
		Schema::table('team_user', function(Blueprint $table) {
			$table->dropForeign('team_user_user_id_foreign');
		});
		Schema::table('team_user', function(Blueprint $table) {
			$table->dropForeign('team_user_team_id_foreign');
		});
		Schema::table('album_team', function(Blueprint $table) {
			$table->dropForeign('album_team_album_id_foreign');
		});
		Schema::table('album_team', function(Blueprint $table) {
			$table->dropForeign('album_team_team_id_foreign');
		});
		Schema::table('games', function(Blueprint $table) {
			$table->dropForeign('games_team_id_foreign');
		});
		Schema::table('coaching', function(Blueprint $table) {
			$table->dropForeign('coaching_user_id_foreign');
		});
	}
}