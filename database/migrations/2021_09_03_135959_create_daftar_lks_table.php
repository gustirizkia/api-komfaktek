<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarLksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_lks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('rekening_id')->constrained('rekenings')->onDelete('cascade');
            $table->string('nama');
            $table->string('email');
            $table->string('nomor_wa');
            $table->string('nomor_mhs');
            $table->string('prodi');
            $table->string('smstr');
            $table->string('alamat');
            $table->date('tgl_lahir');
            $table->string('jk');
            $table->string('foto_diri');
            $table->string('foto_ktm');
            $table->string('foto_ktp')->nullable();
            $table->string('foto_bukti_byr');
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('daftar_lks');
    }
}
