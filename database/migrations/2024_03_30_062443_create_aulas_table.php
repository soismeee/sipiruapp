<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAulasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aulas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_aula');
            $table->string('jumlah_meja');
            $table->string('jumlah_kursi');
            $table->string('jumlah_proyektor');
            $table->string('jumlah_smarttv');
            $table->text('keterangan_lain');
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
        Schema::dropIfExists('aulas');
    }
}
