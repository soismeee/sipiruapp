<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamFasilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjam_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->uuid('peminjaman_id')->index()->comment('Koneksi ke table peminjaman'); // field penghubung ke tabel peminjaman
            $table->string('fasilitas', 25);
            $table->string('qty', 25);
            $table->timestamps();

            $table->foreign('peminjaman_id')->references('id')->on('peminjamen')->onDelete('cascade'); // koneksi dengan table peminjaman
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjam_fasilitas');
    }
}
