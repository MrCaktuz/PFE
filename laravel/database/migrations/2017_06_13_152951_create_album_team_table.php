<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlbumTeamTable extends Migration {

	public function up()
	{
		Schema::create('album_team', function(Blueprint $table) {
			$table->integer('album_id')->unsigned()->index();
			$table->integer('team_id')->unsigned()->index();
		});
	}

	public function down()
	{
		Schema::drop('album_team');
	}
}