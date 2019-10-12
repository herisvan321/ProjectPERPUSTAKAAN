<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukus', function (Blueprint $table) {
            $table->string('kd_buku')->primary();
            $table->string('judul_buku');
            $table->string('isbn');
            $table->string('pengarang');
            $table->string('kelas');
            $table->string('th_terbit');
            $table->integer('halaman')->usigned();
            $table->text('sinopsis');
            $table->integer('jumlah')->usigned();
            $table->string('gambar');
            $table->string('kd_penerbit');
            $table->string('kd_kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bukus');
    }
}
