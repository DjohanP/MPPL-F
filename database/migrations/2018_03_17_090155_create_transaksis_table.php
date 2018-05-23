<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lokasi_id');
            $table->integer('user_id');
            $table->integer('status');
            $table->string('jadwal');
            $table->string('keterangan');
            $table->string('file_upload');
            $table->date('tgl_pinjam');
            $table->time('mulai');
            $table->time('akhir');
            $table->integer('durasi');
            $table->integer('harga');
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
        Schema::dropIfExists('transaksis');
    }
}
