<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('klien_id')->index()->comment('Koneksi ke table klien'); // field penghubung ke klien
            $table->uuid('ja_id')->index()->comment('koneksi ke tabel jadwal aula'); // field penghubung ke jadwal aula

            $table->time('waktu_awal');
            $table->time('waktu_akhir');
            $table->date('tanggal');
            $table->string('keperluan');
            $table->string('status_peminjaman');
            $table->timestamps();

            $table->foreign('klien_id')->references('id')->on('kliens')->onDelete('cascade'); // koneksi dengan table klien
            $table->foreign('ja_id')->references('id')->on('jadwal_aulas')->onDelete('cascade'); // koneksi dengan table jadwal aula
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjamen');
    }
}
