<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('civility')->nullable();
			$table->string('name');
			$table->string('email')->unique();
			$table->date('birthday')->nullable();
			$table->string('birth_location')->nullable();
			$table->string('password');
			$table->string('phone')->nullable();
			$table->string('national_id')->nullable();
			$table->string('photo')->nullable()->default('http://api.adorable.io/avatars/200/profilPic.png');
			$table->string('job')->nullable();
			$table->string('address')->nullable();
			$table->mediumInteger('postal_code')->nullable();
			$table->string('city')->nullable();
			$table->integer('family_id')->unsigned()->nullable();
			$table->integer('jersey_nbr')->nullable();
			$table->timestamps();
			$table->string('remember_token', 100)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}