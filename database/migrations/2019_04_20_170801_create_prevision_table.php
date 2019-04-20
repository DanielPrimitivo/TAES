<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrevisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previsions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rango_hora');
            $table->string('viento');
            $table->string('dirviento');
            $table->string('humedad');
            $table->string('temperatura');
            $table->string('lluvia');
            $table->string('fecha');
            $table->timestamps();

            $table->integer('weather_id')->unsigned();
            $table->foreign('weather_id')->references('id')->on('weathers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('previsions');
    }
}
