<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoachingTable extends Migration {

	public function up()
	{
		Schema::create('coaching', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->text('description');
			$table->string('author');
			$table->string('site')->nullable();
			$table->string('file')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('coaching');
	}
}