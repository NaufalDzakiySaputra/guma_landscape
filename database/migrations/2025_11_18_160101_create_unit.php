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
        Schema::create('unit', function (Blueprint $table) {
        $table->id('id_unit');
        $table->string('nama_unit');
        $table->integer('harga_unit');
        $table->integer('kapasitas');
        $table->enum('status_unit', ['available', 'reserved'])->default('available');
        $table->text('deskripsi_unit')->nullable();
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
        Schema::dropIfExists('unit');
    }
};
