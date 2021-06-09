<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('datetime');
            $table->String('status');
            $table->unsignedBigInteger('id_mapel');
            $table->unsignedBigInteger('id_guru');
            $table->timestamps();
            $table->foreign('id_mapel')->references('id')->on('mata_pelajarans');
            $table->foreign('id_guru')->references('id')->on('gurus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absensis');
    }
}
