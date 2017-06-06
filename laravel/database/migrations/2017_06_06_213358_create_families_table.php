<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFamiliesTable extends Migration {

	public function up()
	{
		Schema::create('families', function(Blueprint $table) {
			$table->increments('id');
			$table->string('family_name');
			$table->string('family_slug');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('families');
	}
}