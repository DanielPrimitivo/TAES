<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fecha');
            $table->string('url');

            $table->integer('coordinate_id')->unsigned();
            $table->foreign('coordinate_id')->references('id')->on('coordinates');

            $table->integer('notice_id')->unsigned();
            $table->foreign('notice_id')->references('id')->on('notices');

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
        Schema::dropIfExists('images');
    }
}
