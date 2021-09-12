<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGagalLksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gagal_lks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daftar_lk_id')->constrained('daftar_lks')->onDelete('cascade');
            $table->longText('pesan');
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
        Schema::dropIfExists('gagal_lks');
    }
}
