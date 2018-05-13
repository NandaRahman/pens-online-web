<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJadwalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kelas')->unsigned();
            $table->foreign('id_kelas')->references('id')->on('kelas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer("id_guru")->unsigned();
            $table->foreign('id_guru')->references('id')->on('guru')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->integer("id_pelajaran")->unsigned();
            $table->foreign('id_pelajaran')->references('id')->on('pelajaran')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('hari', 10);
            $table->integer('jam');
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
        Schema::dropIfExists('jadwal');
    }
}
