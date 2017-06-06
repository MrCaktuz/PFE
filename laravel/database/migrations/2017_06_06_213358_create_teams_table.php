<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamsTable extends Migration {

	public function up()
	{
		Schema::create('teams', function(Blueprint $table) {
			$table->increments('id');
			$table->string('division');
			$table->string('season');
			$table->string('photo')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('teams');
	}
}