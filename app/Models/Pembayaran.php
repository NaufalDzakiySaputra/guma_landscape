<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
     // Nama tabel manual
    protected $table = 'pembayaran';

    // Primary key manual
    protected $primaryKey = 'id_pembayaran';

    // Bisa diisi massal
    protected $fillable = [
        'id_reservasi',
        'tanggal_pembayaran',
        'total_pembayaran',
        'metode_pembayaran',
        'status_pembayaran'
    ];

    // Relasi ke tabel reservasi
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }
}

