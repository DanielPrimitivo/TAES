<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimeHTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('htimes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('viento');
            $table->string('dirviento');
            $table->string('humedad');
            $table->string('temperatura');
            $table->string('lluvia');
            $table->string('fecha');
            $table->string('prevision');
            $table->timestamps();

            $table->integer('hnotice_id')->unsigned();
            $table->foreign('hnotice_id')->references('id')->on('hnotices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('htimes');
    }
}
