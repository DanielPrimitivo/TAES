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
            $table->string('valoracion');
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
        Schema::dropIfExists('senders');
        Schema::dropIfExists('notices');
    }
}
