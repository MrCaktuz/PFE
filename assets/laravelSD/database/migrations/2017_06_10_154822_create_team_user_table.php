<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamUserTable extends Migration {

	public function up()
	{
		Schema::create('team_user', function(Blueprint $table) {
			$table->integer('user_id')->unsigned()->index();
			$table->integer('team_id')->unsigned()->index();
		});
	}

	public function down()
	{
		Schema::drop('team_user');
	}
}