<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts');
            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions');
            $table->string('name');
            $table->string('email')->unique();
            $table->date('birth_of_date');
            $table->string('phone_number');
            $table->string('role')->default('user');
            $table->string('password');
            $table->string('place_of_birth')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('gender')->nullable();;
            $table->string('ktub_number')->nullable();;
            $table->boolean('ktub_editable')->default(false);
            $table->rememberToken();
            $table->timestamps();
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
