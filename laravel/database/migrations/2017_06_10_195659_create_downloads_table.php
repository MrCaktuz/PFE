<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDownloadsTable extends Migration {

	public function up()
	{
		Schema::create('downloads', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('url');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('downloads');
	}
}