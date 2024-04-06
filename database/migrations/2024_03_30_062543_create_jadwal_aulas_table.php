<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_aulas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_sesi');
            $table->time('sesi_awal');
            $table->time('sesi_akhir');
            $table->string('status')->default('aktif');
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
        Schema::dropIfExists('jadwal_aulas');
    }
}
