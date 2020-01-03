<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestKtubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_ktubs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('accepted_admin_id')->nullable();
            $table->foreign('accepted_admin_id')->references('id')->on('users');
            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->string('id_number');
            $table->string('family_card_number');
            $table->string('last_education');
            $table->string('photo_url');
            $table->string('visudhi_name');
            $table->string('visudhi_place');
            $table->string('visudhi_teacher');
            $table->string('visudhi_role');
            $table->string('business_name');
            $table->boolean('is_accepted')->default(false);
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
        Schema::dropIfExists('request_ktubs');
    }
}
