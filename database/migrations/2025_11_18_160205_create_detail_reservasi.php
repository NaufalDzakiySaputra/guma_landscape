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
        Schema::create('detail_reservasi', function (Blueprint $table) {
        $table->id('id_detail');
        $table->unsignedBigInteger('id_reservasi');
        $table->unsignedBigInteger('id_unit');
        $table->integer('jumlah_hari');
        $table->integer('subtotal');
        $table->timestamps();
        $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi');
        $table->foreign('id_unit')->references('id_unit')->on('unit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_reservasi');
    }
};
