<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageTable extends Migration
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
            $table->double('lat');
            $table->double('long');
            $table->string('direccion');
            $table->string('comentarios')->nullable();

            $table->integer('notice_id')->unsigned();
            $table->foreign('notice_id')->references('id')->on('notices')->onDelete('cascade');

            $table->integer('sender_id')->unsigned();
            $table->foreign('sender_id')->references('id')->on('senders')->onDelete('cascade');

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
