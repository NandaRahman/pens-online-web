<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_siswa")->unsigned();
            $table->foreign('id_siswa')->references('id')->on('siswa')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer("id_jadwal")->unsigned();
            $table->foreign('id_jadwal')->references('id')->on('jadwal')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string("status", 1);
            $table->dateTime("absen");
            $table->dateTime("absen_tutup");
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
        Schema::dropIfExists('absen');
    }
}
