<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('range', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keterangan');
            $table->integer('nilai');
            $table->unsignedInteger('kriteriaid');
            $table->timestamps();
            $table->foreign('kriteriaid')->references('id')->on('kriteria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('range');
    }
}
