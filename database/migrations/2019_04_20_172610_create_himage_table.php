<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHimageTable extends Migration
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
            $table->double('lat');
            $table->double('long');
            $table->string('direccion');

            $table->integer('hnotice_id')->unsigned();
            $table->foreign('hnotice_id')->references('id')->on('hnotices');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

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
