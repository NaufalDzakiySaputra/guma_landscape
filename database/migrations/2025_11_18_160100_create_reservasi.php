<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi', function (Blueprint $table) {
        $table->enum('status_reservasi', ['pending', 'confirmed', 'cancelled'])
              ->default('pending');
        $table->integer('jumlah_orang');
        $table->string('waktu_reservasi'); // pagi / siang / malam
        $table->date('tanggal_reservasi');
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai');
        $table->integer('total_harga')->default(0);
        $table->timestamps();

        $table->foreign('id_pengunjung')->references('id_pengunjung')->on('pengunjungs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasi');
    }
};
