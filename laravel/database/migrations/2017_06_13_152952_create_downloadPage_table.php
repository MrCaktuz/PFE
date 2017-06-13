<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDownloadPageTable extends Migration {

	public function up()
	{
		Schema::create('downloadPage', function(Blueprint $table) {
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
		Schema::drop('downloadPage');
	}
}