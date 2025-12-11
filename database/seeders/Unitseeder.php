<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run()
    {
        Unit::create([
            'nama_unit' => 'Villa Standard',
            'harga_unit' => 500000,
            'kapasitas' => 2,
            'status_unit' => 'available',
            'deskripsi_unit' => 'Villa nyaman dengan fasilitas standar'
        ]);

        Unit::create([
            'nama_unit' => 'Villa Deluxe',
            'harga_unit' => 750000,
            'kapasitas' => 4,
            'status_unit' => 'available',
            'deskripsi_unit' => 'Villa mewah dengan pemandangan alam'
        ]);

        Unit::create([
            'nama_unit' => 'Villa Premium',
            'harga_unit' => 1000000,
            'kapasitas' => 6,
            'status_unit' => 'available',
            'deskripsi_unit' => 'Villa eksklusif dengan fasilitas lengkap'
        ]);
    }
}