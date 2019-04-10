<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordinateHTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('h_coordinates', function (Blueprint $table) {
            $table->increments('id');
            $table->float('x');
            $table->float('y');

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
        Schema::dropIfExists('h_coordinates');
    }
}
