<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('value');
			$table->string('description')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}