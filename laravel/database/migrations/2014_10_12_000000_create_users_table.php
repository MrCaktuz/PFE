<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('civility')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('birth_location')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique()->nullable();
            $table->string('national_id')->unique()->nullable();
            $table->string('photo')->nullable();
            $table->string('job')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('family_name')->nullable();
            $table->boolean('family_chef')->default( 0 );
            $table->rememberToken();
            // created_at & updated_at
            $table->timestamps();
            // index
            // $table->unique(['first_name', 'last_name', 'email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
