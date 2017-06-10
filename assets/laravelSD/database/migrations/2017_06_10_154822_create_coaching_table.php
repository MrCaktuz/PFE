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
			$table->integer('user_id')->unsigned()->nullable();
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