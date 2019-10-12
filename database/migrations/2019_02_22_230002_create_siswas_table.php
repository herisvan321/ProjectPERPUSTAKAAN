<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->integer('id_user')->usigned()->primary();
            $table->string('nama_siswa');
            $table->string('nis');
            $table->string('jk');
            $table->string('agama');
            $table->string('tp_lahir');
            $table->date('tgl_lahir');
            $table->string('nohp');
            $table->text('alamat');
            $table->string('foto');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}
