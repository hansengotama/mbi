<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanditasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panditas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vihara_id');
            $table->foreign('vihara_id')->references('id')->on('viharas')->onDelete('cascade');
            $table->string('name');
            $table->string('phone_number');
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
        Schema::dropIfExists('panditas');
    }
}
