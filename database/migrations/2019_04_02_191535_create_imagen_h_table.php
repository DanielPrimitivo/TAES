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
        Schema::create('h_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fecha');
            $table->string('url');

            $table->integer('hcoordinate_id')->unsigned();
            $table->foreign('hcoordinate_id')->references('id')->on('h_coordinates');

            $table->integer('hnotice_id')->unsigned();
            $table->foreign('hnotice_id')->references('id')->on('h_notices');

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
        Schema::dropIfExists('h_images');
    }
}
