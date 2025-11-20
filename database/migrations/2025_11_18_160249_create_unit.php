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
        $table->integer('harga_weekday');
        $table->integer('harga_weekend');
        $table->integer('harga_libur');
        $table->integer('harga_libur_besar')->nullable();
        $table->integer('kapasitas')->default(1);
        $table->enum('status_unit', ['tersedia', 'dipesan', 'maintenance'])->default('tersedia');
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
