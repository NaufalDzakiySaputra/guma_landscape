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
        Schema::create('pembayaran', function (Blueprint $table) {
        $table->id('id_pembayaran');
        $table->unsignedBigInteger('id_reservasi');
        $table->date('tanggal_pembayaran');
        $table->integer('total_pembayaran');
        $table->enum('metode_pembayaran', ['transfer', 'cash']);
        $table->enum('status_pembayaran', ['pending', 'paid'])->default('pending');
        $table->timestamps();
        $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
