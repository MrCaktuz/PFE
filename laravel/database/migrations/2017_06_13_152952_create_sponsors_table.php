<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSponsorsTable extends Migration {

	public function up()
	{
		Schema::create('sponsors', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('url');
			$table->string('image');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('sponsors');
	}
}