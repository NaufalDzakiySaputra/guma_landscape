<?php

namespace Database\Seeders;

use App\Models\HariLibur;
use Illuminate\Database\Seeder;

class HariLiburSeeder extends Seeder
{
    public function run()
    {
        HariLibur::create([
            'tanggal' => '2024-12-25',
            'keterangan' => 'Hari Natal',
            'jenis_libur' => 'nasional'
        ]);

        HariLibur::create([
            'tanggal' => '2025-01-01',
            'keterangan' => 'Tahun Baru',
            'jenis_libur' => 'nasional'
        ]);

        HariLibur::create([
            'tanggal' => '2024-12-31',
            'keterangan' => 'Malam Tahun Baru',
            'jenis_libur' => 'weekend_spesial'
        ]);
    }
}