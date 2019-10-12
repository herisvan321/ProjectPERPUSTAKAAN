<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('kd_act');
            $table->string('kd_buku');
            $table->integer('jumlah')->usigned();
            $table->date('tgl_peminjaman')->nullable();
            $table->date('tgl_j_tempo')->nullable();
            $table->date('tgl_pengembalian')->nullable();
            $table->integer('denda')->nullable();
            $table->string('status');
            $table->integer('id_user')->usigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actions');
    }
}
