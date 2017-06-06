<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhotoTeamTable extends Migration {

	public function up()
	{
		Schema::create('photo_team', function(Blueprint $table) {
			$table->integer('photo_id')->unsigned()->index();
			$table->integer('team_id')->unsigned()->index();
		});
	}

	public function down()
	{
		Schema::drop('photo_team');
	}
}