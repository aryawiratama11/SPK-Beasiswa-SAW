<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailcalonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailcalon', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nilai');
            $table->unsignedInteger('kriteriaid');
            $table->unsignedInteger('calonid');
            $table->foreign('kriteriaid')->references('id')->on('kriteria');
            $table->foreign('calonid')->references('id')->on('calon');
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
        Schema::dropIfExists('detailcalon');
    }
}
