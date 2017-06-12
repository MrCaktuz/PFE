<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRulesTable extends Migration {

	public function up()
	{
		Schema::create('rules', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->text('body');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('rules');
	}
}