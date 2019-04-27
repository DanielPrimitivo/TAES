<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHnoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hnotices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fecha');
            $table->string('categoria');
            $table->boolean('visto');
            $table->double('lat');
            $table->double('long');

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
        Schema::dropIfExists('hnotices');
    }
}
