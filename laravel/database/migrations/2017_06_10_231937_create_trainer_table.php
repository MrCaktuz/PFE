<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrainerTable extends Migration {

	public function up()
	{
		Schema::create('trainer', function(Blueprint $table) {
			$table->increments('id');
			$table->string('key');
			$table->string('name');
			$table->string('value')->nullable();
			$table->string('description')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('trainer');
	}
}