<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('vihara_id')->references('id')->on('viharas')->onDelete('cascade');
            $table->string('name');
            $table->longText('description');
            $table->longText('address');
            $table->timestamp('date_from');
            $table->timestamp('date_until');
            $table->string('poster_url');
            $table->unsignedBigInteger('vihara_id');
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
        Schema::dropIfExists('events');
    }
}
