<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendaHariansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_harians', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->date('tanggal');
            $table->string('jam');
            $table->string('jam2');
            $table->string('tempat');
            $table->string('jenis_agenda');
            $table->enum('tujuan_jenis', ['tujuan_bidang', 'tujuan_orang']);
            $table->bigInteger('tujuan_bidang')->nullable();
            $table->bigInteger('tujuan_orang')->nullable();
            $table->string('keterangan');
            $table->string('file_upload')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agenda_harians');
    }
}
