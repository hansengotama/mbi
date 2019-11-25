<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeceasedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deceaseds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vihara_id');
            $table->foreign('vihara_id')->references('id')->on('viharas')->onDelete('cascade');
            $table->string('region_id');
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->string('name');
            $table->integer('close_age');
            $table->timestamp('buried_date');
            $table->timestamp('deceased_date');
            $table->string('buried_at');
            $table->string('type');
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
        Schema::dropIfExists('deceaseds');
    }
}
