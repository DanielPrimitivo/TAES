<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tlf')->unique();
            $table->string('categoria');
            $table->timestamps();
        });

        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fecha');
            $table->string('categoria');
            $table->boolean('visto');
            $table->double('lat');
            $table->double('long');
            $table->integer('hect'); //cantidad de hectareas quemadas
            $table->integer('prevhect'); //prevision de hectareas quemadas (historicos)
            $table->integer('afect'); //cantidad de personas afectadas
            $table->integer('prevafect'); //prevision de personas afectadas (historicos)
            $table->integer('danyos'); //cantidad en daños materiales 
            $table->integer('prevdanyos'); //prevision de cantidad de daños materiales (historicos)
            $table->double('prec'); //cantidad de precipitaciones L/m^2
            $table->double('prevprec'); //prevision de precipitaciones (historicos)
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
        Schema::dropIfExists('senders');
        Schema::dropIfExists('notices');
    }
}
