<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenHTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('himages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fecha');
            $table->string('url');

            $table->integer('hcoordinate_id')->unsigned();
            $table->foreign('hcoordinate_id')->references('id')->on('hcoordinates');

            $table->integer('hnotice_id')->unsigned();
            $table->foreign('hnotice_id')->references('id')->on('hnotices');

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
        Schema::dropIfExists('himages');
    }
}
